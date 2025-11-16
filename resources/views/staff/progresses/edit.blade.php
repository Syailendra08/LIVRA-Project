@extends('templates.admin')

@section('content')
<div class="container my-5">
     <form method="POST" action="{{ route('staff.progress.update', $plants->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body px-4">

                    {{-- Category --}}
                    <label class="fw-semibold mb-1">Plant Category</label>
                    <select name="category_id" id="category_id"
                        class="form-select input-custom mb-3 @error('category_id') is-invalid @enderror">
                        <option hidden disabled selected>Choose Category...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    {{-- Plant --}}
                    <label class="fw-semibold mb-1">Plant</label>
                    <select name="plant_id" id="plant_id"
                        class="form-select input-custom mb-3 @error('plant_id') is-invalid @enderror">
                        <option hidden disabled selected>Choose Plant...</option>
                        @foreach ($plants as $plant)
                            <option value="{{ $plant->id }}">{{ $plant->plant_name }}</option>
                        @endforeach
                    </select>
                    @error('plant_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="row">
                        {{-- Date --}}
                        <div class="col-md-6">
                            <label class="fw-semibold mb-1">Progress Date</label>
                            <input type="date" name="progress_date" id="progress_date"
                                class="form-control input-custom @error('progress_date') is-invalid @enderror">
                            @error('progress_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Progress Type --}}
                        <div class="col-md-6">
                            <label class="fw-semibold mb-1">Progress Type</label>
                            <select name="progress_type" id="progress_type"
                                class="form-select input-custom @error('progress_type') is-invalid @enderror">
                                <option hidden disabled selected>Choose Type...</option>
                                <option value="planting">Planting</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="harvesting">Harvesting</option>
                            </select>
                            @error('progress_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <label class="fw-semibold mt-3 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="form-control input-custom @error('description') is-invalid @enderror"
                        placeholder="Write progress details here..."></textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- FOOTER -->
                <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
@endsection
