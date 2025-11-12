@extends('templates.admin')
@section('content')
<div class="container mt-3">
    <div class="d-flex justify-content-end mb-3 mt-4">
        <a href="#" class="btn btn-success">Tambah Data</a>
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
</div>
@endsection
