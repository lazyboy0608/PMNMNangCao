<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Rules\NotDescendantOf;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title = "Category List";
        $categories = Category::where('is_delete', false)->get();
        return view('admin.category.index', ['categories' => $categories, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $title = "Add Category";
        $categories = Category::where('is_delete', false)->get();
        return view('admin.category.add', ['title' => $title, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'is_active' => 'nullable|boolean',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $request->image;
        $category->parent_id = $request->parent_id ? $request->parent_id : null;
        $category->is_active = $request->is_active ?? true;
        $category->is_delete = false;
        
        if ($category->parent_id) {
            $parent = Category::find($category->parent_id);
            $category->level = $parent->level + 1;
        } else {
            $category->level = 1;
        }
        
        $category->save();
        return redirect('/category');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $title = "Edit Category";
        $category = Category::find($id);
        
        $descendants = $category->getAllDescendants();
        
        $allCategories = Category::where('is_delete', false)
            ->where('id', '!=', $id)
            ->get();
        
        $currentLevel = $category->getLevel();
        
        $categories = $allCategories->filter(function ($cat) use ($currentLevel, $descendants) {
            return $cat->getLevel() !== $currentLevel && !in_array($cat->id, $descendants);
        })->values();
        
        return view('admin.category.edit', ['category' => $category, 'categories' => $categories, 'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'parent_id' => ['nullable', 'exists:categories,id', new NotDescendantOf($id)],
            'is_active' => 'nullable|boolean',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $request->image;
        
        if ($category->parent_id != $request->parent_id) {
            $category->parent_id = $request->parent_id ? $request->parent_id : null;
            
            if ($category->parent_id) {
                $parent = Category::find($category->parent_id);
                $category->level = $parent->level + 1;
            } else {
                $category->level = 1;
            }
            
            $this->updateDescendantsLevel($category);
        }
        
        $category->is_active = $request->is_active ?? false;
        $category->save();
        return redirect('/category');
    }

    private function updateDescendantsLevel($category)
    {
        $children = Category::where('parent_id', $category->id)->get();
        
        foreach ($children as $child) {
            $child->level = $category->level + 1;
            $child->save();
            
            $this->updateDescendantsLevel($child);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::find($id);
        $category->is_delete = true;
        $category->save();
        return redirect('/category');
    }
}
