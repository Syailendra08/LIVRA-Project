@extends('templates.admin')

@section('content')
<style>
    .btn-filter {
        background-color: #B8EF81;
        color: #367109;
        border: none;
        border-radius: 9999px;
        padding: 0.5rem 1rem;
    }

    .btn-add-plants {
        background-color: #85D747;
        color: white;
        border: none;
        border-radius: 9999px;
        padding: 0.5rem 1rem;
    }

    .btn-filter:hover {
        background-color: #a7f3d0;
    }
</style>

<div class="container-fluid py-4 px-3">
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('failed'))
        <div class="alert alert-danger">{{ Session::get('failed') }}</div>
    @endif

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h2 fw-semibold">Our Plants</h1>
        <div class="d-flex align-items-center gap-3">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Search anything.">
            </div>
            <button class="btn btn-filter d-flex align-items-center">
                Filter by <i class="fa-solid fa-angle-down ms-2"></i>
            </button>
            <a href="{{ route('admin.plants.create') }}" class="btn btn-add-plants d-flex align-items-center">
                <i class="fa-solid fa-plus mx-2"></i> Add Plants
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-borderless mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="p-3"></th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Stock Info</th>
                            <th class="p-3">Category</th>
                            <th class="p-3">Location</th>
                            <th class="p-3">Barcode</th>
                            <th class="p-3 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plants as $plant)
                        <tr>
                            <td class="p-3">
                                <input class="form-check-input" type="checkbox">
                            </td>
                            <td class="p-3">{{ $plant->plant_name }}</td>
                            <td class="p-3">{{ $plant->stock }} In Stock</td>
                            <td class="p-3">{{ $plant->category->category_name ?? '-' }}</td>
                            <td class="p-3">{{ $plant->location }}</td>
                            <td class="p-3">
                                @if($plant->barcode)
                                    <img src="{{ asset('qrcodes/'.$plant->barcode) }}" alt="Barcode" style="height: 32px;">
                                @endif
                            </td>
                            <td class="p-3 text-end">
                                <button class="btn btn-success btn-sm mx-2"
    onclick='showModal({!! json_encode([
        "id" => $plant->id,
        "plant_name" => $plant->plant_name,
        "latin_name" => $plant->latin_name,
        "stock" => $plant->stock,
        "category" => $plant->category->category_name ?? "-",
        "location" => $plant->location,
        "description" => $plant->description,
        "barcode" => $plant->barcode,
        "condition" => $plant->condition,
"habitat" => $plant->habitat,
"health_benefits" => $plant->health_benefits,
"cultural_benefits" => $plant->cultural_benefits,
        "photo" => $plant->photo ? asset("storage/" . $plant->photo) : null,
        "tip" => $plant->tip ? [
            "watering" => $plant->tip->watering,
            "lighting" => $plant->tip->lighting,
            "growing_media" => $plant->tip->growing_media,
        ] : null
    ]) !!})'>
    View Detail
</button>

                                <a href="#" class="btn btn-primary btn-sm mx-2">Edit</a>
                                <form action="{{ route('admin.plants.delete', $plant->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mx-2"
                                        onclick="return confirm('Yakin hapus data ini?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Global -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detail Plant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalDetailBody">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    function showModal(plant) {
    let photoImg = plant.photo
        ? `<img src="${plant.photo}" alt="Plant photo" class="img-fluid rounded mb-3" style="width:100%; height:auto; border-radius: 10px;">`
        : '<em>No photo available</em>';

    let barcodeImg = plant.barcode
        ? `<img src="/qrcodes/${plant.barcode}" alt="QR Code" style="width:100%; max-height: 80px;">` // Barcode disesuaikan agar mirip gambar
        : '<em>No barcode available</em>';

    
    const infoBox = (title, content, bgColor) => `
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100" style="background-color: ${bgColor}; border: none;">
                <div class="card-body p-3">
                    <h5 class="fw-bold" style="color: #333; margin-bottom: 5px;">${title}</h5>
                    <p class="card-text small text-dark">${content ?? '-'}</p>
                </div>
            </div>
        </div>
    `;


    const getTipsContent = () => {
        if (!plant.tip) return '<p>No care tips available.</p>';
        return `
            <div class="row">
                <div class="col-4"># Lighting</div>
                <div class="col-8 small">${plant.tip.lighting ?? 'N/A'}</div>
            </div>
            <div class="row mt-2">
                <div class="col-4"># Growing Media</div>
                <div class="col-8 small">${plant.tip.growing_media ?? 'N/A'}</div>
            </div>
            <div class="row mt-2">
                <div class="col-4"># Watering</div>
                <div class="col-8 small">${plant.tip.watering ?? 'N/A'}</div>
            </div>
        `;
    };

    let content = `
        <div class="row g-3">

            <div class="col-lg-4 d-flex flex-column align-items-center">
                <div class="card shadow-sm p-2 mb-3" style="background-color: #f8f9fa; border: 1px solid #ccc; border-radius: 10px;">
                    ${photoImg}
                </div>
                <div class="text-center w-100 mb-3">
                    ${barcodeImg}
                </div>
            </div>

            <div class="col-lg-8">

                <div class="card p-3 mb-3" style="background-color: #e6ffe6; border: none; border-radius: 10px;">
                    <h4 class="fw-bold" style="color: #4CAF50;">${plant.plant_name ?? 'Plant Detail'}</h4>
                    <p class="small mb-0" style="color: #367109;">${plant.description ?? 'Deskripsi tidak tersedia.'}</p>
                </div>

                <div class="row g-3">
                    ${infoBox('Health Benefits',
                        plant.health_benefits ?? 'No health benefits listed.',
                        '#e8e6ff')} ${infoBox('Cultural Benefits',
                        plant.cultural_benefits ?? 'No cultural benefits listed.',
                        '#ffe6e6')} </div>

                <div class="card p-3 mb-3" style="background-color: #e6efff; border: none; border-radius: 10px;">
                    <h5 class="fw-bold" style="color: #333;">Plant Care Tips</h5>
                    <div class="row mt-2">
                        ${getTipsContent()}
                    </div>
                </div>

                <div class="row g-3">
                    ${infoBox('Habitat',
                        plant.habitat ?? 'N/A',
                        '#ffffe6')} ${infoBox('Condition',
                        plant.condition ?? 'N/A',
                        '#e6ffe6')} </div>
            </div>
        </div>
    `;

    // Perhatikan: Tombol Edit dan Delete tidak dimasukkan di sini, sesuai permintaan.

    document.querySelector("#modalDetailBody").innerHTML = content;
    new bootstrap.Modal(document.querySelector("#modalDetail")).show();
}

</script>
@endpush
