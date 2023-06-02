@extends('layouts.main-auth')

@section('content')
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        {{-- <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="{{ asset('assets/img/logopg.png') }}" alt="">
                                <span class="d-none d-lg-block">Provice Group</span>
                            </a>
                        </div><!-- End Logo --> --}}

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Selamat Datang</h5>
                                    <p class="text-center small">Sistem Reservasi Hotel Bintang</p>
                                </div>
                                @if (Session::has('loginError'))
                                    <div class="pt-3">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('loginError') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif

                                @if (Session::has('success'))
                                    <div class="pt-3">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ Session::get('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif
                                <form action="{{ route('auth.login') }}" method="post" class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <input type="email" name="email" class="form-control"
                                                @error('email') is-invalid @enderror id="email"
                                                placeholder="name@example.com" required autofocus
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message->error }}
                                                </div>
                                            @enderror
                                            {{-- <div class="invalid-feedback">Masukkan email</div> --}}
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                        <div class="invalid-feedback">Masukkan Password</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>
                                    <div class="col-12 text-center">
                                        <p class="small mb-0">Belum punya akun? <a href="register">Register</a></p>
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
@endsection
