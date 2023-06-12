@extends('layouts.main-admin')
@section('content')
    <div class="pagetitle">
        <h1>Kelola Data Kamar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Kelola Data Hotel</li>
                <li class="breadcrumb-item active">Data Kamar</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title d-flex justify-content-start">
                            <a href="{{ route('kelola-kamar.create') }}" type="button" class="btn btn-primary"><i
                                    class="bi bi-plus me-1"></i></a>
                        </h5>
                        <form action="{{ route('kelola-kamar.filter') }}" method="post">
                            @csrf
                            <div class="row mb-3 mt-3">
                                <div class="col-4" hidden>
                                    <label for="start_date" class="form-label">Tanggal mulai</label>
                                    <input type="date" class="form-control mb-1 @error('nama') is-invalid @enderror"
                                        id="start_date" name="start_date"
                                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="start_date" class="form-label">Tanggal mulai</label>
                                    <input type="date"
                                        class="form-control mb-1 @error('start_date') is-invalid @enderror" id="start_date"
                                        name="start_date" value="{{ old('start_date') }}" placeholder="">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="end_date" class="form-label">Tanggal akhir</label>
                                    <input type="date" class="form-control mb-1 @error('end_date') is-invalid @enderror"
                                        id="end_date" name="end_date" value="{{ old('end_date') }}" placeholder="">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-4 d-flex align-items-center justify-content-center">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-funnel me-1"></i>
                                        Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Bordered Table -->
                    <table class="table table-bordered" id="kamarTabel">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nomor</th>
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
                                        @php($status = $statusKamar[$item->no_kamar] ?? 'Ready')

                                        @if ($status == 'Ready')
                                            <span class="badge rounded-pill bg-success">{{ $status }}</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">{{ $status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-between">
                                            <a href="{{ route('kelola-kamar.edit', $item->no_kamar) }}"
                                                class="btn btn-secondary bi bi-pencil-square mx-1"></a>
                                            |
                                            <form action="{{ route('kelola-kamar.destroy', $item->no_kamar) }}"
                                                method="post" onsubmit="return confirm('Yakin akan menghapus data ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" name="submit"
                                                    class="btn btn-danger bi bi-trash mx-1"></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- End Bordered Table -->
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title d-flex justify-content-start">Kamar Tersedia</h5>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Tersedia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($totalReady = 0)
                            @foreach ($jumlahKamarReady as $id_kategori => $jumlah)
                                <tr>
                                    @php($kategori = \App\Models\KategoriKamar::find($id_kategori))
                                    @php($nama_kategori = $kategori->nama_kategori)
                                    <td>{{ $nama_kategori }}</td>
                                    <td>{{ $jumlah }}</td>
                                    @php($totalReady += $jumlah)
                                </tr>
                            @endforeach
                                <tr>
                                    <td class="fw-bold">Total Kamar Ready</td>
                                    <td class="fw-bold">{{ $totalReady }}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.user-modal')
@endsection
@section('sidebar')
    @include('sidebar-admin')
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#kamarTabel').DataTable();
        });
    </script>
@endsection
