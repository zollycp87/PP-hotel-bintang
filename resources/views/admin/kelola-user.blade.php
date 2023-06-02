@extends('layouts.main-admin')
@section('content')
    <div class="pagetitle">
        <h1>Kelola Data User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Kelola Data User</li>
                <li class="breadcrumb-item active">Data User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title d-flex justify-content-start">Data Pengguna</h5>
                <h5 class="card-title d-flex justify-content-end">
                    <a href="{{ route('kelola-user.create') }}" type="button" class="btn btn-primary"><i class="bi bi-plus me-1"></i> Tambah Data</a>
                </h5>
            </div>
            <!-- Bordered Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @php($nomor_urut = 1)
                    @forelse ($posts as $item)
                        <tr>
                            <th scope="row">{{ $nomor_urut++ }}</th>
                            <td>{{ $item->id_user }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->role }}</td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data Post belum Tersedia.
                        </div>
                    @endforelse
                </tbody>
            </table>
            <!-- End Bordered Table -->
        </div>
    </div>

    @include('admin.user-modal')
@endsection
@section('sidebar')
    @include('sidebar-admin')
@endsection
