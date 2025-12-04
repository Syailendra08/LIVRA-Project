@extends('templates.app')

@section('content')
<style>
                        .planters-input-style {
                            border-color: #aaff66 !important;

                            border-width: 2px !important;
                            padding: 10px !important;
                        }


                        .form-label {
                            font-weight: bold;
                            color: #38761d;
                        }

                        .w-50 {
                            background-image: url('../images/bg-plants.jpg');
                            background-size: cover;
                            background-position: center;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            color: white;
                            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
                            font-size: 2em;
                            font-weight: bold;
                        }
                    </style>
    <div class="d-flex" style="min-height: 100vh; background-color: #f7f7f7;">

        <div class="w-75 p-5 bg-white d-flex flex-column justify-content-center">

            <h1 class="mb-5 text-center" style="font-weight: bold;">Hello Planters!</h1>

            <div class="w-75 d-block mx-auto">
                <form method="POST" action="{{ route('signup.send_data') }}">
                    @if (Session::get('failed'))
                        <div class="alert alert-danger my-3">{{ Session::get('failed') }}</div>
                    @endif
                    @csrf

                    <div class="row mb-4">
                        <div class="col">
                            @error('first_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <label class="form-label" for="form3Example1">First Name</label>
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="form3Example1"
                                    class="form-control planters-input-style @error('first_name') is-invalid @enderror"
                                    name="first_name" value="{{ old('first_name') }}" />
                            </div>
                        </div>
                        <div class="col">
                            @error('last_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <label class="form-label" for="form3Example2">Last Name</label>
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="form3Example2"
                                    class="form-control planters-input-style @error('last_name') is-invalid @enderror"
                                    name="last_name" value="{{ old('last_name') }}" />
                            </div>
                        </div>
                    </div>

                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <label class="form-label" for="form3Example3">Email</label>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="form3Example3"
                            class="form-control planters-input-style @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" />
                    </div>

                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <label class="form-label" for="form3Example4">Password</label>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form3Example4"
                            class="form-control planters-input-style @error('password') is-invalid @enderror"
                            name="password" />
                    </div>


                    <button data-mdb-ripple-init type="submit" class="btn btn-block mb-4"
                        style="background-color: #aaff66; color: black; font-weight: bold; border: none; padding: 10px 0;">Register</button>

                    <div class="text-center">
                        <p>or sign up with:</p>
                        <button data-mdb-ripple-init type="button" class="btn btn-success btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </button>

                        <button data-mdb-ripple-init type="button" class="btn btn-success btn-floating mx-1">
                            <i class="fab fa-google"></i>
                        </button>

                        <button data-mdb-ripple-init type="button" class="btn btn-success btn-floating mx-1">
                            <i class="fab fa-twitter"></i>
                        </button>

                        <button data-mdb-ripple-init type="button" class="btn btn-success btn-floating mx-1">
                            <i class="fab fa-github"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <div class="w-50"> Glad To See You!
        </div>
    </div>
@endsection
