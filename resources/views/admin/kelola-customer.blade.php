@extends('layouts.main-admin')
@section('content')
    <div class="pagetitle">
        <h1>Kelola Data Customer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Kelola Data User</li>
                <li class="breadcrumb-item active">Data Customer</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title d-flex justify-content-start">Data Customer</h5>
                <h5 class="card-title d-flex justify-content-end">
                    <a href="{{ route('kelola-user.create') }}" type="button" class="btn btn-primary"><i
                            class="bi bi-plus me-1"></i> Tambah Data</a>
                </h5>
            </div>
            <!-- Bordered Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Nomor Telepon</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Status Customer</th>
                    </tr>
                </thead>
                <tbody>
                    @php($nomor_urut = 1)
                    @forelse ($posts as $item)
                        <tr>
                            <th scope="row">{{ $nomor_urut++ }}</th>
                            <td>{{ $item->id_user }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>
                                @if ($item->status_cust == 'Register')
                                    <span class="badge rounded-pill bg-success">{{ $item->status_cust }}</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">{{ $item->status_cust }}</span>
                                @endif
                            </td>
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
