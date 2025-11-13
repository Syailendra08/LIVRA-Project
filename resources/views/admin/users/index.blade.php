@extends('templates.admin')
@section('content')
@if (Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show alert-top-right" role="alert">
        {{Session::get('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
<div class="container mt-3">
    @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
    <div class="d-flex justify-content-end mb-3 mt-4">
        <a href="{{route('admin.users.create')}}" class="btn btn-success">Tambah Data</a>
    </div>
    <h5>User Data (Admin & Staff)</h5>
     <table class="table my-3 table-bordered" id="userTable">
            <tr>
                <th></th>
                <th class="text-center">Name </th>
                <th class="text-center">Email</th>
                <th class="text-center">Role</th>
                <th class="text-center">Action</th>
            </tr>
            @foreach ($users as $key => $user)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-center">
    @if ($user->role == 'admin')
        <span class="badge badge-primary">admin</span>
    @elseif ($user->role == 'staff')
        <span class="badge badge-success">staff</span>
    @else
        <span class="badge badge-secondary">{{ $user->role }}</span>
    @endif
</td>
                <td class="text-center">
                    <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{route('admin.users.delete', $user->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
</div>
@endsection
