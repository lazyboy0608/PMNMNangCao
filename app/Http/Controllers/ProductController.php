<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckTimeAccess;
use Illuminate\Http\Request;
use App\Models\Product;
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
    public function index()
    {
        //
        $title = "Product List";
        $product = Product::all();
        return view('admin.product.index', ['products' => $product, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $title = "Add Product";
        return view('admin.product.add', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $title = "Product Detail";
        $product = Product::find($id);
        return view('admin.product.detail', ['product' => $product, 'title' => $title]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $title = "Edit Product";
        $product = Product::find($id);
        return view('admin.product.edit', ['product' => $product, 'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();
        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);
        $product->delete();
        return redirect('/product');
    }
}
