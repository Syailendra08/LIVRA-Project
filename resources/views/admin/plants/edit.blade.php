@extends('templates.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 fw-bold">Create Plant</h1>

    <form action="{{ route('admin.plants.update', $plant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">


            <div class="col-md-6">
                <label for="plant_name" class="form-label fw-semibold">Name*</label>
                <input type="text" name="plant_name" id="plant_name"
                       class="form-control @error('plant_name') is-invalid @enderror"
                       value="{{ old('plant_name', $plant->plant_name) }}" required>
                @error('plant_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="category_id" class="form-label fw-semibold">Category*</label>
                <select name="category_id" id="category_id"
                        class="form-select @error('category_id') is-invalid @enderror"
                        value="{{ old('category_id', $plant->category_id) }}" required>
                    <option value="" disabled selected>-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $plant->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="latin_name" class="form-label fw-semibold">Latin Name*</label>
                <input type="text" name="latin_name" id="latin_name"
                       class="form-control @error('latin_name') is-invalid @enderror"
                       value="{{ old('latin_name', $plant->latin_name) }}" required>
                @error('latin_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="condition" class="form-label fw-semibold">Condition*</label>
                <select name="condition" id="condition"
                        class="form-select @error('condition') is-invalid @enderror"
                         required>
                    <option value="" disabled selected>-- Select Condition --</option>
                    <option value="healthy" {{ old('condition', $plant->condition) == 'healthy' ? 'selected' : '' }}>Healthy</option>
                    <option value="sick" {{ old('condition', $plant->condition) == 'sick' ? 'selected' : '' }}>Sick</option>
                    <option value="dead" {{ old('condition', $plant->condition) == 'dead' ? 'selected' : '' }}>Dead</option>
                </select>
                @error('condition')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-12">
                <label for="description" class="form-label fw-semibold">Description*</label>
                <textarea name="description" id="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror"
                          required>{{ old('description', $plant->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="health_benefits" class="form-label fw-semibold">Health Benefits*</label>
                <input type="text" name="health_benefits" id="health_benefits"
                       class="form-control @error('health_benefits') is-invalid @enderror"
                       value="{{ old('health_benefits', $plant->health_benefits) }}" required>
                @error('health_benefits')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="cultural_benefits" class="form-label fw-semibold">Cultural Benefits*</label>
                <input type="text" name="cultural_benefits" id="cultural_benefits"
                       class="form-control @error('cultural_benefits') is-invalid @enderror"
                       value="{{ old('cultural_benefits' , $plant->cultural_benefits) }}" required>
                @error('cultural_benefits')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="watering" class="form-label fw-semibold">Watering*</label>
                <input type="text" name="watering" id="watering"
                       class="form-control @error('watering') is-invalid @enderror"
                       value="{{ old('watering', $plant->tip->watering) }}" required>
                @error('watering')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="lighting" class="form-label fw-semibold">Lighting*</label>
                <input type="text" name="lighting" id="lighting"
                       class="form-control @error('lighting') is-invalid @enderror"
                       value="{{ old('lighting', $plant->tip->lighting ) }}" required>
                @error('lighting')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="growing_media" class="form-label fw-semibold">Growing Media*</label>
                <input type="text" name="growing_media" id="growing_media"
                       class="form-control @error('growing_media') is-invalid @enderror"
                       value="{{ old('growing_media' , $plant->tip->growing_media) }}" required>
                @error('growing_media')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="habitat" class="form-label fw-semibold">Habitat*</label>
                <input type="text" name="habitat" id="habitat"
                       class="form-control @error('habitat') is-invalid @enderror"
                       value="{{ old('habitat', $plant->habitat) }}" required>
                @error('habitat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="location" class="form-label fw-semibold">Location*</label>
                <input type="text" name="location" id="location"
                       class="form-control @error('location') is-invalid @enderror"
                       value="{{ old('location' ,  $plant->location) }}" required>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="stock" class="form-label fw-semibold">Stock*</label>
                <input type="number" name="stock" id="stock"
                       class="form-control @error('stock') is-invalid @enderror"
                       value="{{ old('stock', $plant->stock) }}" min="0" required>
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-12">
                <label for="photo" class="form-label fw-semibold">Plant Photo*</label>
                <input type="file" name="photo" id="photo"
                       class="form-control @error('photo') is-invalid @enderror" >
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

       
        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Update Plant
            </button>
            <a href="{{ route('admin.plants.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
