@extends('layouts.main-cust')
@section('content')
    <!-- form -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-title">Mengubah Data Profile</h4>
                    </div>

                    <form action="{{ route('ubah-profile-cust', Auth::user()->id_user) }}" method="post" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mt-2 ml-1">
                            @if (Session::has('success-profile'))
                                <div class="pt-3">
                                    <div class="alert alert-success">
                                        {{ Session::get('success-profile') }}
                                    </div>
                                </div>
                            @endif
                            <div class="col-5">
                                @if ($data->user->img)
                                    <div class="mb-3 d-flex justify-content-center">
                                        <img src="{{ url('foto') . '/' . $data->user->img }}" alt="" width="100px"
                                            height="100px">
                                    </div>
                                @else
                                    <div class="mb-3 d-flex justify-content-center">
                                        <img src="" alt="" width="100px" height="100px">
                                    </div>
                                @endif
                                <label for="img" class="form-label">Pilih Gambar</label>
                                <input type="file" class="form-control" id="img" name="img">
                            </div>
                            <div class="col-7">
                                <div class="col-12" hidden>
                                    <label for="id_kategori" class="form-label">ID User</label>
                                    <input type="text" class="form-control" id="id_kategori" name="id_kategori"
                                        maxlength="6" value="" placeholder="" aria-label="Disable input example"
                                        readonly>
                                </div>
                                <div class="col-12 mb-1">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $data->user->nama }}">
                                </div>
                                <div class="col-12 mb-1">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $data->user->email }}">
                                </div>

                                <div class="col-12 mb-1">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ $data->user->username }}">
                                </div>

                                <div class="col-12">
                                    <label for="no-hp" class="form-label">No Telepon</label>
                                    <input type="number" class="form-control" id="no-hp" name="no-hp"
                                        value="{{ $data->no_hp }}" maxlength="13" min="0" max="9999999999999">
                                </div>

                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        value="{{ $data->alamat }}">
                                </div>

                                <div class="col-12">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" value="">
                                        <option selected disabled value>Pilih Jenis Kelamin</option>
                                        <option value="1"{{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="2"{{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>

                            </div>
                            <div class="text-center mt-5 mb-5">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ubah password -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Mengubah Password</h5>
                    <form action="{{ route('ubah-password-cust', $data->user->id_user) }}" method="post" class="row g-3"
                        enctype="multipart/form-data" id="passForm" name="passForm">
                        @csrf
                        @method('PUT')
                        {{-- Pesan --}}
                        @if (Session::has('success'))
                            <div class="pt-3">
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            </div>
                        @endif
                        @if (Session::has('loginError'))
                            <div class="pt-3">
                                <div class="alert alert-danger">
                                    {{ Session::get('loginError') }}
                                </div>
                            </div>
                        @endif
                        {{-- Pesan END --}}

                        <div class="row">
                            <div class="col-12">
                                <div class="col-12 mb-2">
                                    <label for="current-password" class="form-floating">Password sekarang</label>
                                    <input type="password"
                                        class="form-control @error('current-password') is-invalid @enderror"
                                        id="current-password" name="current-password" value="">
                                    @error('current-password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="new-password" class="form-floating">Password Baru</label>
                                    <input type="password"
                                        class="form-control @error('new-password') is-invalid @enderror" id="new-password"
                                        name="new-password" value="">
                                    @error('new-password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="confirm-password" class="form-floating">Konfirmasi Password
                                        Baru</label>
                                    <input type="password"
                                        class="form-control @error('confirm-password') is-invalid @enderror"
                                        id="confirm-password" name="confirm-password" value="">
                                    @error('confirm-password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan Password</button>
                        </div>
                    </form><!-- End Profile Edit Form -->
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- NAVBAR --}}
@section('navbar')
    @include('navbar-cust')
@endsection
{{-- NAVBAR END --}}
