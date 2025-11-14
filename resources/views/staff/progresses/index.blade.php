@extends('templates.admin')

@section('content')
<style>
    .btn-filter {
        background-color: #B8EF81;
        color: #367109;
        border: none;
        border-radius: 9999px;
        padding: 0.5rem 1rem;
    }

    .btn-add-plants {
        background-color: #85D747;
        color: white;
        border: none;
        border-radius: 9999px;
        padding: 0.5rem 1rem;
    }

    .btn-filter:hover {
        background-color: #a7f3d0;
    }
</style>

<div class="container-fluid py-4 px-3">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h2 fw-semibold">Our Progress</h1>
        <div class="d-flex align-items-center gap-3">
        <a href="#" class="btn btn-secondary d-flex align-items-center">
                 <i class="fa-solid fa-trash-can-arrow-up mx-2"></i> Recycle Bin
            </a>
            <a href="#" class="btn btn-filter d-flex align-items-center">
                <i class="fa-solid fa-file-export mx-2"></i> Export Excel
            </a>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd">Add Plant</button>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-borderless mb-0">
                <thead class="bg-light">
                        <tr>
                            <th class="p-3">Plant</th>
                            <th class="p-3">Category</th>
                            <th class="p-3">Last Update</th>
                            <th class="p-3">Progress</th>
                            <th class="p-3 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plants as $key => $progress)
                        <tr>
                            <td>{{$progress['plant_name']}}</td>
                            <td>{{$progress['category']['category_name']}}</td>
                            <td>{{ $progress->updated_at->format('d M Y H:i') }}</td>
                            <td class="p-3 text-end">
                                <button class="btn btn-outline-success btn-sm mx-2"
    onclick='showProgressModal({!! json_encode([
        "plant_name" => $progress["plant_name"],
        "progresses" => $progress["progresses"]->map(function($p) {
            return [
                "progress_date" => \Carbon\Carbon::parse($p->progress_date)->format("d M Y"),
                "progress_type" => ucfirst($p->progress_type),
                "description" => $p->description,
            ];
        })
    ]) !!})'>
    <i class="fa-solid fa-seedling"></i> View Progress
</button>

                            </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm mx-2">Edit</a>
                                <form action="#" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mx-2"
                                        onclick="return confirm('Yakin hapus data ini?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>
</div>
{{-- modal --}}
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalAddLabel">Add</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- form --}}
            <form method="POST" action="{{ route('staff.progress.store') }}">
                @csrf
                <div class="modal-body">
                    {{-- Category --}}
                    <div class="mb-3">
                        <label for="category_id" class="col-form-label">Plant Category:</label>
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">
                            <option hidden disabled selected>Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Plant --}}
                    <div class="mb-3">
                        <label for="plant_id" class="col-form-label">Plant:</label>
                        <select name="plant_id" id="plant_id"
                            class="form-select @error('plant_id') is-invalid @enderror">
                            <option hidden disabled selected>Choose Plant</option>
                            @foreach ($plants as $plant)
                                <option value="{{ $plant->id }}">{{ $plant->plant_name }}</option>
                            @endforeach
                        </select>
                        @error('plant_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Progress Type --}}
                    <div class="mb-3">
                        <label for="progress_type" class="form-label">Progress Type:</label>
                        <select name="progress_type" id="progress_type"
                            class="form-select @error('progress_type') is-invalid @enderror">
                            <option hidden disabled selected>Choose Type</option>
                            <option value="planting">Planting</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="harvesting">Harvesting</option>
                        </select>
                        @error('progress_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Progress Date --}}
                    <div class="mb-3">
                        <label for="progress_date" class="form-label">Progress Date:</label>
                        <input type="date" name="progress_date" id="progress_date"
                            class="form-control @error('progress_date') is-invalid @enderror">
                        @error('progress_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" id="description" rows="3"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Write progress details here..."></textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Progress</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end of modal --}}

<!-- Modal: View Progress -->
<div class="modal fade" id="modalProgress" tabindex="-1" aria-labelledby="modalProgressLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalProgressLabel">
          <i class="fa-solid fa-seedling"></i> Progress - <span id="plantName">Plant Name</span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body" id="progressList">
        {{-- Dynamic content will be inserted here --}}
      </div>

      <div class="modal-footer">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd">
          + Add Progress
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
 @if ($errors->any())
        <script>
            let modalAdd = document.querySelector("#modalAdd");
            // munculkan modal dengan JS
            new bootstrap.Modal(modalAdd).show();
        </script>
    @endif
    <script>
function showProgressModal(data) {
    // ubah judul modal
    document.getElementById('plantName').textContent = data.plant_name;

    // ambil container isi modal
    let list = document.getElementById('progressList');
    list.innerHTML = '';

    if (data.progresses && data.progresses.length > 0) {
        data.progresses.forEach(p => {
            let icon = p.progress_type.toLowerCase() === 'harvesting' ? '🌾'
                      : p.progress_type.toLowerCase() === 'maintenance' ? '💧'
                      : '🌱';

            list.innerHTML += `
                <div class="d-flex align-items-start mb-3 border-bottom pb-2">
                    <div class="me-3 fs-4">${icon}</div>
                    <div>
                        <strong>${p.progress_date} - ${p.progress_type}</strong><br>
                        <small class="text-muted">${p.description}</small>
                    </div>
                </div>
            `;
        });
    } else {
        list.innerHTML = `<p class="text-muted text-center">No progress recorded yet.</p>`;
    }

    // tampilkan modal
    let modal = new bootstrap.Modal(document.getElementById('modalProgress'));
    modal.show();
}
</script>
@endpush

