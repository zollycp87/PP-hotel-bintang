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

                    <form action="" method="post" class="row g-3" enctype="multipart/form-data">
                        <div class="row mt-2">
                            <div class="col-4">

                                <div class="mb-3 d-flex justify-content-center">
                                    <img src="assets\images\team\t5.jpg" alt="" width="100px" height="100px">
                                </div>
                                <label for="img" class="form-label">Pilih Gambar</label>
                                <input type="file" class="form-control" id="img" name="img">

                            </div>
                            <div class="col-8">
                                <div class="col-12" hidden>
                                    <label for="id_kategori" class="form-label">ID User</label>
                                    <input type="text" class="form-control" id="id_kategori" name="id_kategori"
                                        maxlength="6" value="" placeholder="" aria-label="Disable input example"
                                        readonly>
                                </div>

                                <div class="col-12 mb-1">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ Auth::user()->nama }}">
                                </div>

                                <div class="col-12 mb-1">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ Auth::user()->email }}">
                                </div>

                                <div class="col-12 mb-1">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ Auth::user()->username }}">
                                </div>

                                <div class="col-12">
                                    <label for="no-hp" class="form-label">No Telepon</label>
                                    <input type="number" class="form-control" id="no-hp" name="no-hp" value=""
                                        maxlength="13" min="0" max="9999999999999">
                                </div>

                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="">
                                </div>

                                <div class="col-12">
                                    <label for="jenis_kelamin" class="form-label">Status Kamar</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin"
                                        value="">
                                        <option selected disabled value>Pilih Jenis Kelamin</option>
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
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
                    <form method="post" class="row g-3" enctype="multipart/form-data" id="passForm" name="passForm">

                        <div class="row">
                            <div class="col-12">

                                <div class="col-12" hidden>
                                    <label for="id_kategori" class="form-label">ID User</label>
                                    <input type="text" class="form-control" id="id_kategori" name="id_kategori"
                                        maxlength="6" value="" placeholder=""aria-label="Disabled input example"
                                        readonly>
                                </div>

                                <div class="col-12 mb-4">
                                    <label for="current-password" class="form-floating">Password sekarang</label>
                                    <input type="password" class="form-control" id="current-password"
                                        name="current-password"value="">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-12 mb-2">
                                    <label for="new-password" class="form-floating">Password Baru</label>
                                    <input type="password" class="form-control" id="new-password" name="new-password"
                                        value="">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-12 mb-2">
                                    <label for="confirm-password" class="form-floating">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="confirm-password"
                                        name="confirm-password" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan Password</button>
                        </div>
                    </form>
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
