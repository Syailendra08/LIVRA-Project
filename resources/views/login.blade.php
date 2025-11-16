@extends('templates.app')

@section('content')
<style>

.w-50 {
    background-image: url('../images/bg-plants.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
    font-size: 2em;
    font-weight: bold;
}

</style>
<div class="d-flex" style="min-height: 100vh; background-color: #f7f7f7;">

    <div class="w-75 p-5 bg-white d-flex flex-column justify-content-center">

        <h1 class="mb-5 text-center" style="font-weight: bold;">Hello Planters!</h1>

        <div class="w-75 d-block mx-auto">
            <form method="POST" action="{{ route('login.send_data') }}">
                @csrf

                @if (Session::get('success'))
                    <div class="alert alert-success my-3">{{ Session::get('success') }}</div>
                @endif

                @if (Session::get('failed'))
                    <div class="alert alert-danger my-3">{{ Session::get('failed') }}</div>
                @endif

                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <label class="form-label" for="form2Example1" style="font-weight: bold; color: #38761d;">Email</label>
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="form2Example1" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                           style="border-color: #aaff66; border-width: 2px; padding: 10px;" />
                </div>

                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <label class="form-label" for="form2Example2" style="font-weight: bold; color: #38761d;">Password</label>
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="form2Example2" class="form-control @error('password') is-invalid @enderror" name="password"
                           style="border-color: #aaff66; border-width: 2px; padding: 10px;" />
                </div>

                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example34" checked />
                            <label class="form-check-label" for="form2Example34"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>

                <button data-mdb-ripple-init type="submit" class="btn btn-block mb-4"
                        style="background-color: #aaff66; color: black; font-weight: bold; border: none; padding: 10px 0;">Sign in</button>

                <div class="text-center">
                    <p>Not a member? <a href="{{route('signup')}}">Register</a></p>
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

    <div class="w-50" >Glad To See You!</div>
</div>
@endsection
