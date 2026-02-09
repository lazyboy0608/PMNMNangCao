@extends('layout.admin')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Validation Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/category/store" method="POST">
        @csrf
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" required>
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br><br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br><br>
        <label for="parent_id">Parent Category:</label>
        <select id="parent_id" name="parent_id">
            <option value="">-- No Parent --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('parent_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br><br>
        <button type="submit">Add Category</button>
    </form>
@endsection