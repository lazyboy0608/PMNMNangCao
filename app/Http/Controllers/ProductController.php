<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckTimeAccess;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [CheckTimeAccess::class];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Product List";
        $query = Product::with('category');
        
        // Filter by keyword or category if provided
        if ($request->has('keyword') && $request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
        
        $products = $query->get();
        $categories = Category::all();
        
        return view('admin.product.index', [
            'products' => $products,
            'title' => $title,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Add Product";
        $categories = Category::all();
        
        return view('admin.product.add', ['title' => $title, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|lte:price',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'is_active' => 'boolean',
        ]);
        
        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }
        
        Product::create($data);
        
        return redirect('/product')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $title = "Product Detail";
    //     $product = Product::with('category')->find($id);
        
    //     if (!$product) {
    //         return redirect('/product')->with('error', 'Product not found');
    //     }
        
    //     return view('admin.product.detail', ['product' => $product, 'title' => $title]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit Product";
        $product = Product::find($id);
        $categories = Category::all();
        
        if (!$product) {
            return redirect('/product')->with('error', 'Product not found');
        }
        
        return view('admin.product.edit', [
            'product' => $product,
            'title' => $title,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return redirect('/product')->with('error', 'Product not found');
        }
        
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|lte:price',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'is_active' => 'boolean',
        ]);
        
        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }
        
        $product->update($data);
        
        return redirect('/product')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return redirect('/product')->with('error', 'Product not found');
        }
        
        // Soft delete - set is_delete to 1
        $product->is_delete = 1;
        $product->save();
        
        return redirect('/product')->with('success', 'Product deleted successfully');
    }
}
