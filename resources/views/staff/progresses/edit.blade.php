@extends('templates.admin')

@section('content')
<div class="container my-5">

    <h3 class="mb-4">Edit Progress for Plant: {{ $plant->plant_name }}</h3>

    <form method="POST" action="{{ route('staff.progress.update', $progress->progress_id) }}">
        @csrf
        @method('PUT')

        <div class="card p-3 mb-4">

            <label>Category</label>
            <select class="form-select mb-2" disabled>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == $progress->category_id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>

            <label>Progress Date</label>
            <input type="date" class="form-control"
                   name="progress_date" value="{{ $progress->progress_date }}">

            <label>Progress Type</label>
            <select class="form-select" name="progress_type">
                <option value="planting" {{ $progress->progress_type == 'planting' ? 'selected' : '' }}>Planting</option>
                <option value="maintenance" {{ $progress->progress_type == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="harvesting" {{ $progress->progress_type == 'harvesting' ? 'selected' : '' }}>Harvesting</option>
            </select>

            <label>Description</label>
            <textarea class="form-control" name="description">{{ $progress->description }}</textarea>

        </div>

        <button type="submit" class="btn btn-primary">Update Progress</button>
    </form>

</div>
@endsection
