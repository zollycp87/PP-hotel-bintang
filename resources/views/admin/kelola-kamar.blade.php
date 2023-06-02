@extends('layouts.main-admin')
@section('content')
    <div class="pagetitle">
        <h1>Kelola Data User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Kelola Data Hotel</li>
                <li class="breadcrumb-item active">Data Kamar</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title d-flex justify-content-start">Data Kamar</h5>
                <h5 class="card-title d-flex justify-content-end">
                    <a href="{{ route('kelola-kamar.create') }}" type="button" class="btn btn-primary"><i class="bi bi-plus me-1"></i> Tambah Data</a>
                </h5>
            </div>
            <!-- Bordered Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nomor Kamar</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php($nomor_urut = 1)
                    @forelse ($posts as $item)
                        <tr>
                            <th scope="row">{{ $nomor_urut++ }}</th>
                            <td>{{ $item->no_kamar }}</td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            <td>Rp. {{ $item->kategori->harga_kategori }}</td>
                            <td>
                                @if ($item->status == "Ready" )
                                    <span class="badge rounded-pill bg-success">{{ $item->status }}</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-between">
                                    <a href="{{ route('kelola-kamar.edit', $item->no_kamar) }}"
                                        class="btn btn-secondary bi bi-pencil-square mx-1"></a>
                                    |
                                    <form action="{{ route('kelola-kamar.destroy', $item->no_kamar) }}" method="post"
                                        onsubmit="return confirm('Yakin akan menghapus data ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="submit" class="btn btn-danger bi bi-trash mx-1"></button>
                                    </form>
                                </div>
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
