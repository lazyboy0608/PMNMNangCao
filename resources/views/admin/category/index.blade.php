@extends('layout.admin')
@section('content')
<div class="mb-3">
        <a href="/category/add" class="btn btn-success btn-lg">
            <i class="fas fa-plus"></i> Add New Category
        </a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Parent Name</th>
                <th>Is Active</th>
                <th>Is Delete</th>
                <th style="width: 200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category['id'] }}</td>
                <td>{{ $category['name'] }}</td>
                <td>{{ $category['description'] }}</td>
                <td>{{ $category['image'] }}</td>
                <td>{{ $category->parent ? $category->parent->name : '' }}</td>
                <td>{{ $category['is_active'] }}</td>
                <td>{{ $category['is_delete'] }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="/category/edit/{{ $category['id'] }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="/category/delete/{{ $category['id'] }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">
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