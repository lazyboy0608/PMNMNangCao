@extends('layout.admin')
@section('content')
    <form action="/product/update/{{ $product->id }}" method="POST">
        @csrf
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="{{ $product->name }}" required>
        <br><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="{{ $product->price }}" required>
        <br><br>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="{{ $product->stock }}" required>
        <br><br>
        <button type="submit">Update Product</button>
    </form>
@endsection