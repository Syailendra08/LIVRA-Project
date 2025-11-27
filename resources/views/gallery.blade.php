@extends('templates.app')

@section('content')
<style>
.bg-light-green {
    background-color: #E2FFB5;
}
.hero-section {
    border-radius: 15px;
    overflow: hidden;
}
.hero-section img {
    object-fit: cover;
    height: 70vh;
}
.overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.5);
}
.hero-text {
    max-width: 700px;
    padding: 15px;
}
.search-box {
    display: flex;
    align-items: center;
    background: #fff;
    border-radius: 25px;
    padding: 8px 15px;
    max-width: 350px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.search-box i {
    font-size: 1.2rem;
    margin-right: 10px;
    color: #333;
}
.search-box input {
    border: none;
    outline: none;
    flex: 1;
    box-shadow: none !important;
}
.cards-container {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* pas 5 kolom */
    gap: 12px;
}
.cards-container .card {
    border-radius: 12px;
    width: 245px; /* kecil */
    height: 330px; /* tinggi sedang */
    margin: auto;
    transition: transform 0.2s ease;
}
.cards-container .card:hover {
    transform: scale(1.03);
}
.cards-container .card img {
    height: 230px;
    object-fit: cover;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}
.cards-container .card-body {
    background-color:#C7F9CC;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
    padding: 12px;
}
</style>

<div class="bg-light-green py-5">
    <div class="container">
        <div class="hero-section position-relative text-center text-white">
            <img src="{{ asset('images/hero.jpg') }}" class="img-fluid rounded w-100" alt="Gambar Tanaman Hias">
            <div class="overlay"></div>
            <div class="hero-text position-absolute top-50 start-50 translate-middle">
                <h1 class="fw-bold display-5">This is our Plant</h1>
                <p class="lead">
                    Find out all you need to know about plants, including their health benefits,
                    easy care tips, and fun facts!!
                </p>
            </div>
        </div>
    </div>

    <br>

    <!-- Discover Section -->
    <section class="py-4 px-3 rounded" style="background-color:#E2FFB5;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <form action="{{ route('gallery')}}" method="GET">
                @csrf
            <div class="search-box mb-4">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search_plant" class="form-control" placeholder="Search anything..">
            </div>
            </form>
            <div class="dropdown mb-3">
    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
        Sort By
    </button>

    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('gallery', ['sort' => 'category']) }}">Category</a></li>
        <li><a class="dropdown-item" href="{{ route('gallery', ['sort' => 'alphabet']) }}">Alphabet (A-Z)</a></li>
        <li><a class="dropdown-item" href="{{ route('gallery', ['sort' => 'newest']) }}">Newest</a></li>
        <li><a class="dropdown-item" href="{{ route('gallery', ['sort' => 'oldest']) }}">Oldest</a></li>
    </ul>
</div>

            <h3 class="fw-bold mb-0 pb-5">Discover Our Plants</h3>
        </div>

        <!-- Cards -->
        <div class="cards-container">
            @forelse ($plants as $plant)
             <a href="{{ route('plants.show', $plant->id) }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('storage/' . $plant->photo) }}"
                         onerror="this.src='{{ asset('images/default-plant.jpg') }}';"
                         class="card-img-top"
                         alt="{{ $plant->plant_name }}">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="fw-bold mb-1">{{ $plant->plant_name }}</h6>
                            <p class="text-muted fst-italic mb-0" style="font-size: 0.85rem;">
                                {{ $plant->latin_name ?? '-' }}
                            </p>
                        </div>
                        <p class="fw-bold mb-0 text-end" style="font-size: 0.85rem; color:#2E7D32;">
                            {{ $plant->stock }} in stock
                        </p>
                    </div>
                </div>
             </a>
            @empty
                <p class="text-center text-muted">No plants available yet.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
