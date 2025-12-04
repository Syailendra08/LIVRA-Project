@extends('templates.admin')

@section('content')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold">Recycle Bin - Progress</h2>

        <a href="{{ route('staff.progress.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">Plant</th>
                            <th class="ps-4 py-3">Category</th>
                            <th class="ps-4 py-3">Progress Type</th>
                            <th class="ps-4 py-3">Deleted At</th>
                            <th class="ps-4 py-3">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($progressTrash as $item)
                        <tr>
                            <td>{{ $item->plant->plant_name }}</td>
                            <td>{{ $item->category->category_name }}</td>
                            <td>{{ ucfirst($item->progress_type) }}</td>
                            <td>{{ $item->deleted_at->format('d M Y H:i') }}</td>

                            <td class="d-flex gap-2">

                                <form action="{{ route('staff.progress.restore', $item->progress_id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-trash-can-arrow-up"></i> Restore
                                    </button>
                                </form>

                                <form action="{{ route('staff.progress.forceDelete', $item->progress_id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete permanently? This cannot be undone!')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-xmark"></i> Delete Permanently
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                No deleted progress found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection
