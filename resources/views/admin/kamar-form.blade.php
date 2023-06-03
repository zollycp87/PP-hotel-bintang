@extends('layouts.main-admin')
@section('content')
    @if (Route::currentRouteName() == 'kelola-kamar.create')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Menambah Data Kamar</h5>
                <br>
                @include('komponen.pesan')
                <form action="{{ route('kelola-kamar.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                                <label for="no_kamar" class="form-label">No Kamar</label>
                                <input type="text" class="form-control mb-1" id="no_kamar" name="no_kamar"
                                    maxlength="6" value="{{ $kode }}" placeholder=""
                                    aria-label="Disabled input example" readonly>
                            </div>
                            <div class="col-12">
                                <label for="id_kategori" class="form-label">Pilih Kategori Kamar</label>
                                <select class="form-select mb-1" aria-label="Default select example" name="id_kategori"
                                    id="id_kategori">
                                    <option selected disabled value>Pilih Jenis Paket</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="status" class="form-label">Status Kamar</label>
                                <select class="form-select" id="status" name="status"
                                    value="{{ Session::get('status') }}">
                                    <option selected disabled value>Pilih Status Kamar</option>
                                    <option value="1">Ready</option>
                                    <option value="2">Booked</option>
                                </select>
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
                <h5 class="card-title">Mengubah Data Kamar</h5>
                <br>
                @include('komponen.pesan')
                <form action="{{ route('kelola-kamar.update', $data->no_kamar) }}" method="post" class="row g-3"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                                <label for="no_kamar" class="form-label">No Kamar</label>
                                <input type="text" class="form-control mb-1" id="no_kamar" name="no_kamar"
                                    maxlength="6" value="{{ $data->no_kamar }}" placeholder=""
                                    aria-label="Disabled input example" readonly>
                            </div>
                            <div class="col-12">
                                <label for="id_kategori" class="form-label">Pilih Kategori Kamar</label>
                                <select class="form-select mb-1" aria-label="Default select example" name="id_kategori"
                                    id="id_kategori">
                                    {{-- <option disabled value>Pilih Jenis Paket</option> --}}
                                    <option selected value="{{ $data->id_kategori }}">{{ $data->kategori->nama_kategori }}
                                    </option>
                                    @foreach ($kategori as $item)
                                        @if ($item->id_kategori !== $data->id_kategori)
                                            <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="status" class="form-label">Status Kamar</label>
                                <select class="form-select" id="status" name="status">
                                    <option selected disabled value>Pilih Status Kamar</option>
                                    <option value="1"{{ $data->status == 'Ready' ? 'selected' : '' }}>Ready</option>
                                    <option value="2"{{ $data->status == 'Booked' ? 'selected' : '' }}>Booked</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button> |
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
            </div>
            </form><!-- Vertical Form -->
            {{-- END --}}
        </div>
    @endif
@endsection
@section('sidebar')
    @include('sidebar-admin')
@endsection
