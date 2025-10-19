@extends('templates.admin')
@section('content')

    <h2 class="mb-5">Create New Category</h2>
    <form action="{{ route('admin.category.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="categoryName" class="form-label">Category Name</label>
            <input type="text" id="categoryName" name="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name') }}" >
            @error('category_name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="categoryDescription" class="form-label">Description</label>
            <textarea id="categoryDescription" name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Category</button>
@endsection
