@extends('layout.admin')
@section('content')
    <div class="mb-3">
        <a href="{{ route('add') }}" class="btn btn-success btn-lg">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th style="width: 200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['name'] }}</td>
                <td>${{ number_format($product['price'], 2) }}</td>
                <td>{{ $product['stock'] }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('edit', ['id' => $product['id']]) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('delete', ['id' => $product['id']]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection