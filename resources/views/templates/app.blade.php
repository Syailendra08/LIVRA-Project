<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livra</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .navbar {
            height: 90px;
        }
        .navbar-brand img {
            height: 90px;
            width: auto;
        }
        .btn-custom {
            font-weight: 500;
            padding: 8px 24px;
        }
        .btn-custom-login {
            background-color: #B8EF81;
            color: #367109;
        }
        .btn-custom-register {
            background-color: transparent;
            color: #367109;
            border: 2px solid #367109;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-white">
        <div class="container">
            <a class="navbar-brand me-2" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}"
                    height="60px" alt="MDB Logo" loading="lazy" style="margin-top: -1px;" />
            </a>

          <li class="nav-item">
                            <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
                        </li>

            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <div class="d-flex align-items-center ms-auto">
                    @if (Auth::check())
                    <a href="{{route('logout')}}" class="btn btn-link px-3 me-2">
                        Logout
                    </a>
                    @else
                    <a href="{{ route('login') }}" data-mdb-ripple-init type="button" class="btn btn-custom btn-custom-login px-3 me-2">
                        Login
                    </a>
                    <a href="{{route ('signup')}}" data-mdb-ripple-init type="button" class="btn btn-custom btn-custom-register me-3">
                        Register
                    </a>
                    @endif
                </div>
            </div>
            </div>
        </nav>

    @yield('content')
     <footer class="text-center py-3">
    <div class="container">
        <p class="text-muted md-5">
            Copyright &copy; 2025 - All rights reserved by LIVRA Teams
        </p>
    </div>
</footer>
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"
    ></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
