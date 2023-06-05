@extends('layouts.main-auth')
@section('content')
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            {{-- <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">NiceAdmin</span>
                                </a>
                            </div><!-- End Logo --> --}}

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Buat Akun Baru</h5>
                                        <p class="text-center small">Selamat datang di Sistem Reservasi Hotel Bintang</p>
                                    </div>
                                    @include('komponen.pesan')
                                    <form action="{{ route('register.store') }}" method="post" class="row g-3" >
                                        @csrf
                                        {{-- Hidden input --}}
                                        <input type="text" name="id_customer" id="id_user" value="{{ $kode }}" hidden>
                                        <input type="text" name="id_user" id="id_user" value="{{ $kode }}" hidden>
                                        <input type="text" name="role" id="role" value="{{ 'Tamu' }}" hidden>
                                        <input type="text" name="status" id="status" value="{{ 'Register' }}"  hidden>

                                        <div class="col-12">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control" id="nama"
                                                value="{{ old('nama') }}">
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ old('email') }}">
                                        </div>

                                        <div class="col-12">
                                            <label for="username" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                                                <input type="text" name="username" class="form-control" id="username"
                                                    value="{{ old('username') }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                value="{{ old('password') }}">
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox"
                                                    value="" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">I agree and accept the <a
                                                        href="#">terms and conditions</a></label>
                                                <div class="invalid-feedback">Setujui layanan kami untuk melanjutkan</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit"
                                                id="submitRegister">Register</button>
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="small mb-0">Sudah punya akun? <a href="login">Log
                                                    in</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                Copyright <i class="bi bi-c-circle"></i> 2023</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <script>
        document.getElementById('acceptTerms').addEventListener('change', function() {
            document.getElementById('submitRegister').disabled = !this.checked;
        });
    </script>
@endsection
