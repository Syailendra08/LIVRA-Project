@extends('templates.app')
@push('style')
    <style>
        .alert-top-right {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
            min-width: 250px;
        }
        </style>

@section('content')
@if (Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show alert-top-right" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<style>
    .hero-section {
       background: linear-gradient(to left, #65FF13 20%, #15C52C 100%, #9FFF5A 100%);
        color: white;
        padding: 100px 0;
        display: flex;
        align-items: center;
        min-height: 500px;
    }
    .hero-text h1 {
        font-size: 3.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    .hero-text p {
        font-size: 1.25rem;
        margin-bottom: 30px;
    }
    .btn-start-now {
        background-color: #B8EF81;
        color: #367109;
        font-weight: bold;
        padding: 15px 30px;
        border-radius: 30px;
        border: none;
        font-size: 1.1rem;
    }
    .hero-image img {
        max-width: 100%;
        height: auto;
    }
     .feature-card {
            border: 2px solid #a9d494;
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
            height: 100%;
        }
        .feature-card h4 {
            font-weight: bold;
            color: #333;
            margin-bottom: 1rem;
        }
        .feature-card p {
            font-size: 1rem;
            color: #333;
            margin-bottom: 0;
        }
         .step-card {
            background-color: #fff;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }
          .step-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .step-number {
            background-color: #4CAF50;
            color: #fff;
            font-size: 1.25rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 40px;
            width: 40px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .step-card h4 {
            font-weight: bold;
            margin-bottom: 0;
            color: #333;
        }
        .step-card p {
            color: #666;
            margin-bottom: 0;
        }
    </style>
    <div class="hero-section mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 hero-text">
                <h1>Manage your plants smarter not harder, with LIVRA</h1>
                <p>LIVRA is a modern plant management application designed to help you organize, care for, and monitor your plant collection with ease and efficiency.</p>
                <a href="#" class="btn btn-start-now">Start Now</a>
            </div>
            <div class="col-md-5 hero-image">
                <img src="{{ asset('images/watering.png') }}" alt="Plant Management Illustration">
            </div>
        </div>
    </div>
</div> <br> <br>

<div class="container my-5 mb-5">
    <div class="row align-items-center">
        <h2 class="fw-bold mb-3 text-center fw-bold">What is LIVRA?</h2>
        <div class="col-md-4">
            <img src="{{ asset('images/planting.png') }}" alt="What is LIVRA" class="img-fluid">
        </div>
        <div class="col-md-7">
            <p class="fs-5">
                Living In a Green Era is a digital platform built to support plant management activities.
                With a simple interface and complete features, LIVRA makes it easier for users to record,
                track, and analyze plant growth in real time.
            </p>
        </div>
    </div>
</div> <br> <br>

  <div class="container py-5 mb-5">
        <h2 class="text-center mb-6 fw-bold ">Why Choose Livra?</h2>
        <br>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Practical</h4>
                    <p>Keep all your plant data neatly organized in one application.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Detailed Information</h4>
                    <p>Each plant includes descriptions, health benefits, cultural values, care tips, and habitat details.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Easy Monitoring</h4>
                    <p>Track plant progress through clear charts and daily records.</p>
                </div>
            </div>
        </div>
    </div> <br> <br>

<div class="hero-section mb-5">
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold ">How Does It Work?</h2>

    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="step-card">
                <div class="step-title">
                    <span class="step-number">1</span>
                    <h4>Input Data</h4>
                </div>
                <p>Add plant information such as name, category, location, stock, and barcode.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-title">
                    <span class="step-number">2</span>
                    <h4>Track Progress</h4>
                </div>
                <p>Record growth stages from planting to care and harvest using the Plant Progress feature.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="step-card">
                <div class="step-title">
                    <span class="step-number">3</span>
                    <h4>Gain Insights</h4>
                </div>
                <p>Access data through detailed pop-ups, charts, and reports.</p>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
