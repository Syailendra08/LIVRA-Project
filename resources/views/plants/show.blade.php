@extends('templates.admin')

@section('content')
<style>
    /* Card header: name + description like the screenshot */
.plant-header {
    background-color: #e6f9e9; /* hijau muda */
    border-radius: 12px;
    padding: 18px 20px;
    margin-bottom: 12px;
    box-shadow: inset 0 0 0 1px rgba(0,0,0,0.03); /* subtle inner border */
}

/* Title inside header */
.plant-header .plant-title {
    color: #1f7a3c;       /* hijau gelap */
    font-weight: 700;
    font-size: 1.25rem;   /* agak besar */
    margin: 0 0 8px 0;
}

/* Description inside header */
.plant-header .plant-desc {
    color: #234f2b;       /* sedikit kontras, tetap gelap */
    margin: 0;
    line-height: 1.45;
    font-size: 0.95rem;
}

/* Jika teks terlalu panjang, batasi lebar untuk estetika */
.plant-header .plant-desc.long {
    max-width: 60ch; /* opsional: batasi jumlah karakter per baris */
    display: block;
}

    .plant-card {
        background-color: #f6faff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
    }

    .plant-image {
        flex: 1 1 280px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .plant-image img {
        border-radius: 12px;
        width: 100%;
        max-width: 320px;
        object-fit: cover;
    }

    .plant-info {
        flex: 2 1 500px;
    }

    .plant-title {
        color: #276749;
        font-weight: 700;
    }

    .info-section {
        background-color: #fff;
        border-radius: 10px;
        padding: 12px 16px;
        margin-bottom: 12px;
    }

    .info-section h5 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 6px;
    }
    /* Wrapper untuk Health & Cultural agar sejajar */
.benefit-section {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 12px;
}

/* Masing-masing kotak menyesuaikan lebar */
.benefit-section .info-section {
    flex: 1 1 calc(50% - 8px);
    border-radius: 12px;
    padding: 14px 18px;
    border: 1px solid transparent;
}

/* Style khusus sesuai contoh */
.info-section.blue {
    background-color: #f0f4ff;
    border-color: #b3c6ff;
}

.info-section.blue h5 {
    color: #2b4fff;
}

.info-section.orange {
    background-color: #fff5ef;
    border-color: #ffbb80;
}

.info-section.orange h5 {
    color: #c55a00;
}

/* Responsif: kalau layar kecil, jadi satu kolom */
@media (max-width: 768px) {
    .benefit-section .info-section {
        flex: 1 1 100%;
    }

    .care-item {
        flex: 1 1 100%;
    }

    .habitat-condition {
        flex-direction: column;
    }
}

.care-section {
    background-color: #f0f4ff;
    border: 1px solid #b3c6ff;
    border-radius: 12px;
    padding: 16px 20px;
    color: #002bff;
    margin-bottom: 14px;
}

.care-section h5 {
    color: #002bff;
    font-weight: 600;
    margin-bottom: 10px;
}

/* Grid layout untuk tips */
.care-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
}

.care-item {
    flex: 1 1 calc(33.333% - 10px);
    min-width: 200px;
}

.care-item h6 {
    font-weight: 700;
    color: #002bff;
    font-size: 0.95rem;
    margin-bottom: 4px;
}

.care-item p {
    color: #002bff;
    font-size: 0.9rem;
    margin: 0;
    line-height: 1.4;
}

/* Habitat & Condition sejajar */
.habitat-condition {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 16px;
}

.info-box {
    flex: 1 1 calc(50% - 8px);
    border-radius: 12px;
    padding: 14px 18px;
    border: 1px solid #ddd;
}

/* Habitat styling */
.habitat-box {
    background-color: #fffecf;
    border-color: #fff799;
}

.habitat-box h5 {
    color: #d4af37;
    font-weight: 700;
}

/* Condition default */
.condition-box {
    background-color: #fff;
    border: 1px solid #ddd;
}

.condition-box h5 {
    color: #888;
    font-weight: 700;
    margin-bottom: 6px;
}

/* Warna kondisi */
.condition-healthy p {
    color: #22aa22;
    font-weight: 600;
}

.condition-sick p {
    color: #e3b300;
    font-weight: 600;
}

.condition-dead p {
    color: #d93025;
    font-weight: 600;
}






    .info-section.blue { background-color: #e3f2fd; }
    .info-section.orange { background-color: #fff3e0; }
    .info-section.yellow { background-color: #fff8e1; }
    .info-section.green { background-color: #e8f5e9; }

    .barcode {
        margin-top: 10px;
        width: 120px !important;
        height: auto !important;       /* biar proporsional */
    display: block;
    }
</style>

<div class="container mt-4">
    <div class="plant-card">
        {{-- Gambar dan Barcode --}}
        <div class="plant-image">
            <img src="{{ asset('storage/' . $plant->photo) }}" alt="{{ $plant->plant_name }}">
            <img src="{{ asset('storage/qrcodes/' . $plant->barcode . '.svg') }}" class="barcode" alt="barcode">
        </div>

        {{-- Detail Informasi --}}
        <div class="plant-info">
            <div class="plant-header">
    <h3 class="plant-title">{{ $plant->plant_name }}</h3>
    <p><em>Latin Name: {{ $plant->latin_name ?? '-' }}</em></p>
    <p class="plant-desc {{ strlen($plant->description ?? '') > 200 ? 'long' : '' }}">
        {{ $plant->description ?? '-' }}
    </p>
</div>


            <div class="benefit-section">
    <div class="info-section blue">
        <h5>Health Benefits</h5>
        <p>{{ $plant->health_benefits ?? '-' }}</p>
    </div>

    <div class="info-section orange">
        <h5>Cultural Benefits</h5>
        <p>{{ $plant->cultural_benefits ?? '-' }}</p>
    </div>
</div>


           <div class="care-section">
    <h5>Plant Care Tips</h5>
    <div class="care-grid">
        <div class="care-item">
            <h6># Lighting</h6>
            <p>{{ $plant->tip->lighting ?? '-' }}</p>
        </div>
        <div class="care-item">
            <h6># Growing Media</h6>
            <p>{{ $plant->tip->growing_media ?? '-' }}</p>
        </div>
        <div class="care-item">
            <h6># Watering</h6>
            <p>{{ $plant->tip->watering ?? '-' }}</p>
        </div>
    </div>
</div>


           <div class="habitat-condition">
    <div class="info-box habitat-box">
        <h5>Habitat</h5>
        <p>{{ $plant->habitat ?? '-' }}</p>
    </div>

    <div class="info-box condition-box
        {{ strtolower($plant->condition) === 'healthy' ? 'condition-healthy' : '' }}
        {{ strtolower($plant->condition) === 'sick' ? 'condition-sick' : '' }}
        {{ strtolower($plant->condition) === 'dead' ? 'condition-dead' : '' }}">
        <h5>Condition</h5>
        <p>{{ ucfirst($plant->condition) }}</p>
    </div>
</div>


            <p><strong>Location:</strong> {{ $plant->location }}</p>
            <p><strong>Stock:</strong> {{ $plant->stock }}</p>
        </div>
    </div>
</div>
@endsection
