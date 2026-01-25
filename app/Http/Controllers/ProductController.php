<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $title = "Product List";
        return view('product.index', ['title' => $title,
            'products' => [
                ['id' => 1, 'name' => 'Product A', 'price' => 100],
                ['id' => 2, 'name' => 'Product B', 'price' => 200],
                ['id' => 3, 'name' => 'Product C', 'price' => 300],
            ]
        ]);
    }
    public function create()
    {
        return view('product.add');
    }
    public function store(Request $request)
    {
        // Logic to store the new product
        dd($request->all());
    }
    public function getDetail(string $id = "123")
    {
        return view('product.detail', ['id' => $id]);
    }
    public function login()
    {
        return view('login');
    }
    public function checkLogin(Request $request)
    {
        if($request->input('username') === 'vietnh' && $request->input('password') === '1') {
            return "Login successful!";
        } else {
            return "Login failed!";
        }
    }
}
