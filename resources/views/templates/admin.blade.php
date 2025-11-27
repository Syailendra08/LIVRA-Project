<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livra</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />4
     <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        .alert-top-right {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
            min-width: 250px;
        }

        .sidebar-livra {
            width: 280px;
            min-height: 100vh;
            background-color: white;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .nav-link-livra {
            color: #212529;
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border-radius: 8px;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .nav-link-livra:hover {
            background-color: #f0f0f0;
            color: #000;
        }

        .nav-link-livra.active {
            background-color: #28a745;
            /* Warna hijau */
            color: white;
        }

        .nav-link-livra.active .bi {
            color: white;
        }

        .nav-link-livra i {
            font-size: 1.25rem;
            margin-right: 12px;
            color: #6c757d;
        }

        .nav-link-livra.active i {
            color: white;
        }

        .section-title {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            padding-left: 16px;
        }

        .content-area {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar-livra p-3">
        <div class="logo text-center mb-5">
            <img src="{{ asset('images/logo.png') }}" alt="Logo LIVRA" class="img-fluid">
        </div>


        <ul class="nav flex-column mb-3">
            <li class="nav-item">
                @if (auth()->user()->role == 'admin')
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link nav-link-livra {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-grip"></i> Dashboard
                </a>
                @elseif (auth()->user()->role == 'staff')
                <a href="{{ route('staff.dashboard') }}"
                    class="nav-link nav-link-livra {{ Request::routeIs('staff.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-grip"></i> Dashboard
                </a>
                @endif
            </li>
            <p class="section-title">Plant Management</p>
            @if (Auth::check() && Auth::user()->role == 'admin')
            <li class="nav-item">
                <a href="{{ route('admin.plants.index') }}"
                    class="nav-link nav-link-livra {{ Request::routeIs('admin.plants.index*') ? 'active' : '' }}">
                    <i class="fa-solid fa-seedling"></i> Plants
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.category.index') }}" class="nav-link nav-link-livra">
                    <i class="fa-solid fa-layer-group"></i> Plant Categories
                </a>
            </li>
            <p class="section-title">User Management</p>
            <a href="{{route('admin.users.index')}}" class="nav-link nav-link-livra">
                    <i class="fa-solid fa-users"></i></i> User Data
                </a>
            @elseif (Auth::check() && Auth::user()->role == 'staff')
            <li class="nav-item">
                <a href="{{route('staff.progress.index')}}" class="nav-link nav-link-livra">
                    <i class="fa-solid fa-bars-progress"></i> Plant Progress
                </a>
            </li>
            @endif
        </ul>

        <hr class="my-4">

        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.plants.create') }}"
                class="nav-link nav-link-livra {{ Request::routeIs('admin.plants.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-circle-plus"></i> Add Plant
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link nav-link-livra text-danger">
                    <i class="fa-solid fa-door-open"></i> Log Out
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content flex-grow-1 p-4">
        @yield('content')
    </div>
</div>

{{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- Stack for custom scripts --}}
    @stack('script')
</body>
</html>
