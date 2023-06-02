@extends('layouts.main-admin')
@section('content')
    @if (Route::currentRouteName() == 'kelola-kategori.create')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Menambah Data Kategori Kamar</h5>
                <br>
                @include('komponen.pesan')
                <form action="{{ route('kelola-kategori.store') }}" method="post" class="row g-3"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="img" class="form-label">Pilih Gambar</label>
                                <input class="form-control" type="file" id="img" name="img">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="col-12">
                                <label for="id_kategori" class="form-label">ID Kategori</label>
                                <input type="text" class="form-control" id="id_kategori" name="id_kategori"
                                    maxlength="6" value="{{ $kode }}" placeholder=""
                                    aria-label="Disabled input example" readonly>
                            </div>
                            <div class="col-12">
                                <label for="nama_kategori" class="form-floating">Nama Kategori Kamar</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                    value="{{ Session::get('nama_kategori') }}">
                            </div>
                            <div class="col-12">
                                <label for="harga_kategori" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="harga_kategori" name="harga_kategori"
                                    value="{{ Session::get('harga_kategori') }}">
                            </div>
                            <div class="col-12">
                                <label for="deskripsi" class="form-label">Deskripsi Fasilitas Kategori</label>
                                <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ Session::get('deskripsi') }}"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button> |
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
            </div>
            </form><!-- Vertical Form -->
            {{-- END --}}
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Mengubah Data Kategori</h5>
                <br>
                @include('komponen.pesan')
                <form action="{{ route('kelola-kategori.update', $data->id_kategori) }}" method="post" class="row g-3"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-4">
                        @if($data->img)
                        <div class="mb-3 d-flex justify-content-center">
                            <img src="{{ url('foto') . '/' . $data->img }}" alt="" width="200px"
                            height="200px">
                        </div>
                        @endif
                            <div class="mb-3">
                                <label for="img" class="form-label">Pilih Gambar</label>
                                <input class="form-control" type="file" id="img" name="img">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="col-12">
                                <label for="id_kategori" class="form-label">ID Kategori</label>
                                <input type="text" class="form-control" id="id_kategori" name="id_kategori"
                                    maxlength="6" value="{{ $data->id_kategori }}" placeholder=""
                                    aria-label="Disabled input example" readonly>
                            </div>
                            <div class="col-12">
                                <label for="nama_kategori" class="form-floating">Nama Kategori Kamar</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                    value="{{ $data->nama_kategori }}">
                            </div>
                            <div class="col-12">
                                <label for="harga_kategori" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga_kategori"
                                    value="{{ $data->harga_kategori }}">
                            </div>
                            <div class="col-12">
                                <label for="deskripsi" class="form-label">Deskripsi Fasilitas Kategori</label>
                                <textarea type="text" class="form-control" id="deskripsi" name="deskripsi"
                                    value="{{ $data->deskripsi }}">{{ $data->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button> |
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- Vertical Form -->
            </div>
            {{-- END --}}
        </div>
    @endif
@endsection
@section('sidebar')
    @include('sidebar-admin')
@endsection
