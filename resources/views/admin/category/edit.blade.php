@extends('templates.admin')
@section('content')

    <h2 class="mb-5">Edit Category</h2>
    <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="categoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name', $category->category_name) }}" >
            @error('category_name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="categoryDescription" class="form-label">Description</label>
            <textarea class="form-control" id="categoryDescription" name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="textdanger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
@endsection
