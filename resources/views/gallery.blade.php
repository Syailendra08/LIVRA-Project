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
    width: 245px;   /* lebih kecil */
    height: 330px;  /* lebih tinggi */
    margin: auto;   /* biar rapi di grid */
}
.cards-container .card img {
    height: 230px; /* gambar agak tinggi */
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
            <div class="search-box mb-4">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="form-control" placeholder="Search anything..">
            </div>
            <!-- Title -->
            <h3 class="fw-bold mb-0 pb-5">Discover Our Plants</h3>
        </div>

        <!-- Cards -->
        <!-- Cards -->
<!-- Cards -->
<div class="cards-container">
    @for ($i = 0; $i < 5; $i++)
        <div class="card border-0 shadow-sm">
            <img src="{{ asset('images/broccoli.jpg') }}"
                 class="card-img-top" alt="Wortel">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h6 class="fw-bold mb-1">Wortel</h6>
                    <p class="text-muted fst-italic mb-0" style="font-size: 0.85rem;">Daucus carota</p>
                </div>
                <p class="fw-bold mb-0 text-end" style="font-size: 0.85rem; color:#2E7D32;">12 in stock</p>
            </div>
        </div>
    @endfor
</div>

    </section>
</div>

</div>
@endsection
