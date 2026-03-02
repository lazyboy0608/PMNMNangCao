@extends('layout.admin')
@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">{{ $title }}</h5>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Validation Errors:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                    <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="price" class="form-label">Price (₫) <span class="text-danger">*</span></label>
                    <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" 
                        step="0.01" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="sale_price" class="form-label">Sale Price (₫)</label>
                    <input type="number" id="sale_price" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" 
                        step="0.01" value="{{ old('sale_price') }}">
                    @error('sale_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                    <input type="number" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror" 
                        value="{{ old('stock', 0) }}" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" id="is_active" name="is_active" class="form-check-input" value="1" checked>
                    <label class="form-check-label" for="is_active">
                        Active
                    </label>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
