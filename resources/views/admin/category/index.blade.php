@extends('templates.admin')

@section('content')
@if (Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show alert-top-right" role="alert">
        {{Session::get('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
<div class="container mt-4">
     @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Categories</h2>
            <small class="text-muted">
                Last update {{ $lastUpdate->updated_at->format('F d, Y \a\t h:i A') }}
            </small>
        </div>
        <a href="{{ route('admin.category.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus mx-2"></i> Add Category
        </a>

    </div>

    <!-- Categories Grid -->
   <div class="row g-4">
    @foreach ($categories as $category)
        <div class="col-md-4">
            <div class="category-card position-relative">

                <!-- Action Icons -->
                <div class="action-icons position-absolute top-0 end-0 m-2 d-flex">
                    <!-- Edit -->
                    <a href="#" class="text-primary me-2">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('admin.category.delete', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn p-0 border-0 bg-transparent text-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>

                <!-- Card Content -->
                <div class="category-icon">
                    <i class="fa-solid fa-seedling"></i>
                </div>
                <div class="category-info">
                    <h5 class="fw-bold mb-1">{{ $category->category_name }}</h5>
                    <p class="text-muted mb-0">{{ $category->description ?? 'No description' }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>

<!-- Custom CSS -->
<style>
    .category-card {
        background-color: #d4fcd4; /* hijau muda */
        border-radius: 15px;
        padding: 15px;
        text-align: left;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .category-icon {
        background-color: #b5f5b5; /* hijau sedikit lebih tua */
        border-radius: 12px;
        padding: 40px;
        text-align: center;
        margin-bottom: 15px;
    }

    .category-icon i {
        font-size: 2rem;
        color: #1b5e20; /* hijau gelap */
    }

    .category-info h5 {
        font-weight: 700;
        color: #000;
    }

    .category-info p {
        margin: 0;
        font-size: 0.9rem;
    }
</style>
@endsection
