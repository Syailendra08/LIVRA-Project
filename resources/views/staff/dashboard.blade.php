@extends('templates.admin')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
            /* Latar belakang abu-abu muda */
        }

        .card {
            border-radius: 12px;
        }

        .text-gray-800 {
            color: #343a40;
        }

        .text-gray-900 {
            color: #212529;
        }

        .text-green {
            color: #28a745;
        }

        .bg-light-green {
            background-color: #e6f7e9;
        }

        .bg-green-light {
            background-color: #e6f7e9;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-control {
            border-radius: 50px;
        }

        .input-group-text {
            background-color: white;
            border-right: none;
            border-top-left-radius: 50px;
            border-bottom-left-radius: 50px;
        }

        .form-control:focus,
        .form-control:active {
            box-shadow: none;
            border-color: #ced4da;
        }

        .table thead th {
            border-bottom: 2px solid #e9ecef;
        }
    </style>

    <div class="container-fluid py-4">
        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert"
                style="z-index: 1100;">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold text-gray-800">Dashboard</h2>
            <div class="d-flex align-items-center">
                <div class="input-group me-3">
                    <span class="input-group-text bg-white border-end-0 rounded-start-pill"><i
                            class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 rounded-end-pill"
                        placeholder="Search anything...">
                </div>
                <a href="#" class="btn btn-light-gray rounded-circle p-2 position-relative">
                    <i class="bi bi-bell-fill text-muted fs-5"></i>
                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill">3</span>
                </a>
                <a href="#" class="btn btn-light-gray rounded-circle p-2 ms-2">
                    <i class="bi bi-person-circle text-muted fs-5"></i>
                </a>
            </div>
        </div>


        <div class="row g-4 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm rounded-3 border-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div
                                class="card-icon rounded-circle p-2 me-2 mb-2 bg-light-green d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-list"></i>
                            </div>
                            <h6 class="text-muted  mb-0">Plant Categories</h6>
                            <h3 class="fw-bold text-gray-900">{{ $totalCategories }}</h3>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-green-light text-green px-2 py-1 rounded-pill">+5%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm rounded-3 border-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="card-icon rounded-circle p-2 me-2 mb-2 bg-light-green d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-spa"></i>
                            </div>
                            <h6 class="text-muted  mb-0">Total Plants</h6>
                            <h3 class="fw-bold text-gray-900">{{ $totalPlants }}</h3>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-green-light text-green px-2 py-1 rounded-pill">+5%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm rounded-3 border-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="card-icon rounded-circle p-2 me-2 mb-2 bg-light-green d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-spinner"></i>
                            </div>
                            <h6 class="text-muted  mb-0">Total Progress</h6>
                            <h3 class="fw-bold text-gray-900">120</h3>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-green-light text-green px-2 py-1 rounded-pill">+5%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm rounded-3 border-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="card-icon rounded-circle p-2 me-2 mb-2 bg-light-green d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <h6 class="text-muted  mb-0">Total User</h6>
                            <h3 class="fw-bold text-gray-900">{{$totalUsers }}</h3>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-green-light text-green px-2 py-1 rounded-pill">+5%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row g-4 mb-4 d-flex align-items-stretch">
            <div class="col-lg-6 d-flex">
                <div class="card p-4 shadow-sm rounded-3 border-0 w-100">
                    <h5 class="fw-bold text-gray-800">Plant Chart</h5>
                    <div class="d-flex align-items-center justify-content-center flex-wrap flex-grow-1">
                        <div class="w-50">
                            <canvas id="pieChart"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex">
                <div class="card p-4 shadow-sm rounded-3 border-0 w-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-gray-800">Plant Location</h5>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill">Yearly <i
                                class="bi bi-chevron-down"></i></button>
                    </div>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

        <div class="card p-4 shadow-sm rounded-3 border-0">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-gray-800 mb-0">Plants Table List</h5>
                <div class="d-flex align-items-center">
                    <div class="input-group me-3">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0" placeholder="Search anything..">
                    </div>
                    <a href="#" class="btn btn-primary">See all</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class=" text-muted   fw-normal">Plant Name</th>
                            <th class=" text-muted   fw-normal">Category</th>
                            <th class=" text-muted   fw-normal">Description</th>
                            <th class=" text-muted   fw-normal">Location</th>
                            <th class=" text-muted   fw-normal">User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-info-circle me-2"></i> No data available.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
