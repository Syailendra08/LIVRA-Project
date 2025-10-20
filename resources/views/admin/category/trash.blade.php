@extends('templates.admin')

@section('content')
<div class="container mt-4">
     @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif




    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Recycle Bin Category</h2>
            @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

        </div>
        <div class="d-flex justify-content-end mb-3 mt-4 mx-2">
            <a href="{{ route('admin.category.index') }}" class="btn btn-primary mb-3">
                <i class="fa-solid fa-arrow-left mx-2"></i> Back to Categories
            </a>
        </div>


    </div>

    <!-- Categories Grid -->
   <div class="row g-4">
    @foreach ($categoryTrash as $category)
        <div class="col-md-4">
            <div class="category-card position-relative">

                <!-- Action Icons -->
                <div class="action-icons position-absolute top-0 end-0 m-2 d-flex">
                    <!-- Edit -->
                     <form action="{{route('admin.category.restore', $category['id'])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn p-0 border-0 bg-transparent text-success me-2">
                            <i class="fa-solid fa-recycle"></i>
                        </button>
                    </form>

                    <!-- Delete -->
                    <form class="ms-2" action="{{route('admin.category.delete_permanent', $category['id'])}}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn p-0 border-0 bg-transparent text-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>


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
