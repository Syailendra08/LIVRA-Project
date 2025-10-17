@extends('templates.admin')

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold">{{ $plant->plant_name }}</h1>
    <p><strong>Latin Name:</strong> {{ $plant->latin_name }}</p>
    <p><strong>Category:</strong> {{ $plant->category->category_name ?? '-' }}</p>
    <p><strong>Condition:</strong> {{ ucfirst($plant->condition) }}</p>
    <p><strong>Description:</strong> {{ $plant->description }}</p>
    <p><strong>Health Benefit:</strong> {{ $plant->health_benefits }}</p>
    <p><strong>Cultural Benefits:</strong> {{ $plant->cultural_benefits }}</p>
    <p><strong>Watering:</strong> {{ $plant->tip->watering ?? '-' }}</p>
    <p><strong>Lighting:</strong> {{ $plant->tip->lighting ?? '-' }}</p>
    <p><strong>Growing Media:</strong> {{ $plant->tip->growing_media ?? '-' }}</p>
    <p><strong>Habitat:</strong>{{ $plant->habitat ?? '-' }}</p>
    <p><strong>Location:</strong> {{ $plant->location }}</p>
    <p><strong>Stock:</strong> {{ $plant->stock }}</p>

    @if($plant->photo)
        <div class="mt-3">
            <img src="{{ asset('storage/' . $plant->photo) }}" alt="{{ $plant->plant_name }}" width="300">
        </div>
    @endif
</div>
@endsection
