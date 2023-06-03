@extends('layouts.main-admin')
@section('content')
    @if (Route::currentRouteName() == 'kelola-user.create')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Menambah Data Admin</h5>
                <br>
                @include('komponen.pesan')
                <form action="{{ route('kelola-user.store') }}" method="post" class="row g-3">
                    @csrf
                    {{-- Hidden input --}}
                    <input type="text" name="id_user" id="id_user" value="{{ $kode }}" hidden>
                    <input type="text" name="role" id="role" value="{{ 'Admin' }}" hidden>

                    <div class="col-12" hidden>
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" id="nama"
                            value="{{ '-' }}">
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email"
                            value="{{ old('email') }}">
                    </div>

                    <div class="col-12" hidden>
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group has-validation">
                            {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                            <input type="text" name="username" class="form-control" id="username" value="-">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" name="password" class="form-control" id="password"
                            value="{{ 'admin1234' }}" disable readonly>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button> |
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
            {{-- END --}}
        </div>
    @else
        <div class="row">
            {{-- UBAH PROFILE --}}
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mengubah Data Profil</h5>
                        <!-- Profile Edit Form -->
                        <form action="{{ route('ubah-profile', $data->id_user) }}" method="post" class="row g-3"
                            enctype="multipart/form-data">
                            {{-- @include('komponen.pesan') --}}
                            @csrf
                            @method('PUT')
                            <div class="row mt-2">
                                <div class="col-4">
                                    @if ($data->img)
                                        <div class="mb-3 d-flex justify-content-center">
                                            <img src="{{ url('foto') . '/' . $data->img }}" alt="" width="100px"
                                                height="100px">
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label for="img" class="form-label">Pilih Gambar</label>
                                        <input class="form-control" type="file" id="img" name="img">
                                    </div>
                                </div>
                                <div class="col-8 ">
                                    <div class="col-12" hidden>
                                        <label for="id_kategori" class="form-label">ID User</label>
                                        <input type="text" class="form-control" id="id_kategori" name="id_kategori"
                                            maxlength="6" value="{{ $data->id_user }}" placeholder=""
                                            aria-label="Disabled input example" readonly>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="nama_kategori" class="form-floating">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                            value="{{ $data->nama }}">
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="nama_kategori" class="form-floating">Username</label>
                                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                            value="{{ $data->username }}">
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="nama_kategori" class="form-floating">Email</label>
                                        <input type="text" class="form-control" id="nama_kategori"
                                            name="nama_kategori" value="{{ $data->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form><!-- End Profile Edit Form -->
                    </div>
                    {{-- END --}}
                </div>
            </div>
            {{-- END --}}

            {{-- UBAH PASSWORD --}}
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mengubah Password</h5>
                        <!-- Profile Edit Form -->
                        <form action="{{ route('ubah-password', $data->id_user) }}" method="post" class="row g-3"
                            enctype="multipart/form-data" id="passForm" name="passForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="col-12" hidden>
                                        <label for="id_kategori" class="form-label">ID User</label>
                                        <input type="text" class="form-control" id="id_kategori" name="id_kategori"
                                            maxlength="6" value="{{ $data->id_user }}" placeholder=""
                                            aria-label="Disabled input example" readonly>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label for="current-password" class="form-floating">Password sekarang</label>
                                        <input type="password" class="form-control @error('current-password') is-invalid @enderror" id="current-password" name="current-password" value="">
                                        @error('current-password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="new-password" class="form-floating">Password Baru</label>
                                        <input type="password" class="form-control @error('new-password') is-invalid @enderror" id="new-password"
                                            name="new-password" value="">
                                        @error('new-password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="confirm-password" class="form-floating">Konfirmasi Password
                                            Baru</label>
                                        <input type="password" class="form-control @error('confirm-password') is-invalid @enderror" id="confirm-password"
                                            name="confirm-password" value="">
                                        @error('confirm-password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan Password</button>
                            </div>
                        </form><!-- End Profile Edit Form -->
                    </div>
                    {{-- END --}}
                </div>
            </div>
            {{-- UBAH PASSWWORD END --}}
        </div>
    @endif
@endsection
@section('sidebar')
    @include('sidebar-admin')
@endsection
