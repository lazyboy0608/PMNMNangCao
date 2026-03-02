@extends('layout.admin')
@section('content')
    <div class="mb-3">
        <a href="{{ route('product.create') }}" class="btn btn-success btn-lg">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    <!-- Search and Filter -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('product.index') }}" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="keyword" class="form-control" placeholder="Search by product name" value="{{ request('keyword') }}">
                </div>
                <div class="col-md-6">
                    <select name="category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12" style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Sale Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Is Deleted</th>
                <th style="width: 200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>
                    @if ($product->sale_price)
                        ${!! '<del style="color:red;">' . number_format($product->price, 2) . '</del>' !!}
                        <span class="badge bg-danger">${{ number_format($product->sale_price, 2) }}</span>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $product->stock }}</td>
                <td>
                    @if ($product->is_active === 1)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-warning">Inactive</span>
                    @endif
                </td>
                <td>
                    @if ($product->is_delete === 1)
                        <span class="badge bg-danger">Deleted</span>
                    @else
                        <span class="badge bg-success">Available</span>
                    @endif
                <td>
                    <div class="btn-group" role="group">
                        {{-- <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-info btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                        </a> --}}
                        <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center text-muted">No products found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection
