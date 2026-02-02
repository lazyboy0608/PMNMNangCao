@extends('layout.admin')
@section('content')
    <form action="/product/store" method="POST">
        @csrf
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
        <br><br>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>
        <br><br>
        <button type="submit">Add Product</button>
    </form>
@endsection