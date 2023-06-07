@extends('layouts.main-cust')

@section('content')
    @if (Auth::check())
        <p>HAI</p>
    @else
        <article class="entry">
            <div class="entry-content">
                <!-- head title-->
                <div class="bg-cornflower-blue mb-lg-7">
                    <div class="pt-lg-5 d-flex align-items-center">
                        <div class="container mb-lg-5 ">
                            <div class="row d-flex">
                                <div class="col-lg-6 mn-7 order-lg-1"><img
                                        src="{{ asset('customer/assets/images/logo/logo.png') }}" alt="home">
                                </div>
                                <div class="col-lg-6 col-md-12 pb-lg-4 my-auto">
                                    <div class="mt-lg-0 mt-md-5 mt-4">
                                        <div class="pr-lg-6 pr-md-6">
                                            <h3 class="mt-3 mb-4 text-white">Selamat Datang</h3>
                                            <div class="pt-2">
                                                <p class="lead mb-4 text-white">Sambut Kedatangan Anda dengan Penuh
                                                    Kehangatan di Hotel Strategis dan Terjangkau</p>
                                            </div><a class="btn btn-white text-cornflower-blue mt-4"
                                                href="page-about-us.html">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- icon box-->
                <div class="container mt-2">
                    <div class="row gx-lg-5">
                        <div class="col-lg-4">
                            <div class="bg-athens-gray">
                                <div class="px-4 py-5">
                                    <div class="px-2"> <i class="fas fa-shield-alt icon-border bg-cornflower-blue"></i>
                                        <h4 class="mb-3">Aman</h4>
                                        <p class="mb-0">Keamanan barang bawaan dan Kerahasian tamu terjaga.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-lg-0 mt-md-4 mt-3">
                            <div class="bg-cornflower-blue">
                                <div class="px-4 py-5">
                                    <div class="px-2"><i
                                            class="px-3 fas fa-handshake icon-border bg-white text-cornflower-blue"></i>
                                        <h4 class="mb-3 text-white">Terjangkau dan Strategis</h4>
                                        <p class="mb-0 text-white">Kami menawarkan kamar dengan harga yang terjangkau dan
                                            memiliki tempat yang mudah di akses.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-lg-0 mt-md-4 mt-3">
                            <div class="bg-brilliant-rose">
                                <div class="px-4 py-5">
                                    <div class="px-2"><i
                                            class="px-4 fas fa-file-contract icon-border bg-white text-brilliant-rose"></i>
                                        <h4 class="mb-3 text-white">Cepat dan Mudah</h4>
                                        <p class="mb-0 text-white">Dalam melakukan booking yang dilakukan dapat secara
                                            cepat dan mudah.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mt-lg-7 mb-lg-5 mt-md-6 mb-md-4 mt-5 mb-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h1 class="mb-4">Booking Kamar</h1>
                            <div class="pr-6">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- property-->
                <div class="container">
                    <div class="row gx-lg-5 property-block">
                        @foreach ($kategoris as $kategori)
                            <div class="col-lg-4">
                                <article class="property-item">
                                    <div class="content-image"><img src="{{ url('foto') . '/' . $kategori->img }}"
                                            alt="property">
                                    </div>
                                    <h5 class="content-title"><a href="">{{ $kategori->nama_kategori }}</a></h5>
                                    <div class="content-price">Rp{{ number_format($kategori->harga_kategori, 0, '.', ',') }}
                                    </div>
                                    <span class="content-meta">{{ $kategori->deskripsi }}</span>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="container text-center"><a class="btn btn-athens-gray text-ebonny-clay"
                        href="page-property-list.html">Lihat kamar lainnya</a></div>
                <!-- memeber-->
                <div class="container my-lg-9 my-md-7 my-5">
                    <div class="row gx-lg-0">
                        <div class="col-lg-6"><img src="assets/images/home/h3.jpg" alt="member"></div>
                        <div class="col-lg-6 mn-6 bg-livender my-auto">
                            <div class="py-lg-6 px-lg-6 py-md-6 px-md-5 py-5 px-4"><i
                                    class="mb-4 h2 display-5 fas fa-quote-left text-cornflower-blue"></i>
                                <p class="paragraph-extend mb-lg-5 mb-md-4 mb-3">Mari menginap di Hotel Bintang Flores
                                    nikmati sensasi kenyamanan menginap di hotel kami dengan pelayanan hotel bintang 2 serta
                                    dengan harga yang terjangkau.</p>
                                <h5>Ponco Muji Astuti</h5>
                                <p class="mb-0">Owner</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ready to get started-->
                <div class="bg-cornflower-blue">
                    <div class="container">
                        <div class="py-lg-8 py-md-7 py-6">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <div class="text-center">
                                        <h1 class="mb-3 text-white">Booking Klik Dibawah Ini</h1>
                                        <div class="pt-3">
                                            <p class="px-lg-6 mb-5 text-white"></p>
                                        </div><a class="btn btn-white text-cornflower-blue" href="login">Booking now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    @endif
@endsection

{{-- NAVBAR --}}
@section('navbar')
    {{-- Jika Login --}}
    @if (Auth::check())
        <div class="site-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container"><a class="navbar-brand" href="index.html">
                        <h4>Hotel Bintang Flores</h4>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" href="#"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                                <div class="dropdown-menu"><a class="dropdown-item" href="page-about-us.html">About
                                        Us</a><a class="dropdown-item" href="page-contact.html">Contact Us</a></div>
                            </li>
                            <!-- <li class="nav-item dropdown mega_menu_holder"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Blog</a>
                                                    <div class="dropdown-menu"><a class="dropdown-item" href="blog.html">Blog</a><a class="dropdown-item" href="blog-right-sidebar.html">Right Sidebar</a><a class="dropdown-item" href="blog-left-sidebar.html">Left Sidebar</a><a class="dropdown-item" href="blog-three-col.html">Three Col</a><a class="dropdown-item" href="blog-two-col-right-sidebar.html">Two Col Right Sidebar</a><a class="dropdown-item" href="blog-two-col-left-sidebar.html">Two Col Left Sidebar</a><a class="dropdown-item" href="blog-card-right-sidebar.html">Card Right Sidebar</a><a class="dropdown-item" href="blog-card-left-sidebar.html">Card Left Sidebar</a><a class="dropdown-item" href="blog-card-three-col.html">Card Three Col</a><a class="dropdown-item" href="blog-card-two-col-right-sidebar.html">Card two Col Right Sidebar</a><a class="dropdown-item" href="blog-card-two-col-left-sidebar.html">Card two Col Left Sidebar</a><a class="dropdown-item" href="blog-single-post.html">Single Post</a><a class="dropdown-item" href="blog-single-post-gallery.html">Single Gallary Post </a><a class="dropdown-item" href="blog-single-post-video.html">Single Video Post</a><a class="dropdown-item" href="blog-single-post-audio.html">Single Audio Post</a></div>
                                                </li> -->
                            <li class="nav-item dropdown mega_menu_holder"><a class="dropdown-toggle nav-link"
                                    href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Booking</a>
                                <div class="dropdown-menu"><a class="dropdown-item"
                                        href="page-property-list.html">Booking
                                        Kamar</a><a class="dropdown-item" href="property-single.html">Detail Kamar</a>
                                </div>
                            </li>
                            <!-- <li class="nav-item"><a class="nav-link" href="element-accordions.html">Element</a></li> -->
                            <li class="nav-item"><a class="nav-link" href="page-riwayat.html">Riwayat</a></li>
                        </ul>
                        <ul class="nav-modules">
                            <!-- Login-->
                            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" href="#">Hai,
                                    {{ Auth::user()->nama }}</a>
                                <div class="dropdown-menu"><a class="dropdown-item" href="profile.html">Profile</a><a
                                        class="dropdown-item" href="index.html">Log Out</a></div>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        {{-- Jika Login END --}}
    @else
        <div class="site-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container"><a class="navbar-brand" href="index.html">
                        <h3>Hotel Bintang Flores</h3>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="index.html">About Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="index.html">Room</a></li>
                            <li class="nav-item"><a class="nav-link" href="index.html">Contact Us</a></li>
                            {{-- <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" href="#"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                                <div class="dropdown-menu"><a class="dropdown-item" href="page-about-us.html">About
                                        Us</a><a class="dropdown-item" href="page-contact.html">Contact Us</a></div>
                            </li> --}}
                            <!-- <li class="nav-item dropdown mega_menu_holder"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Blog</a>
                                                        <div class="dropdown-menu"><a class="dropdown-item" href="blog.html">Blog</a><a class="dropdown-item" href="blog-right-sidebar.html">Right Sidebar</a><a class="dropdown-item" href="blog-left-sidebar.html">Left Sidebar</a><a class="dropdown-item" href="blog-three-col.html">Three Col</a><a class="dropdown-item" href="blog-two-col-right-sidebar.html">Two Col Right Sidebar</a><a class="dropdown-item" href="blog-two-col-left-sidebar.html">Two Col Left Sidebar</a><a class="dropdown-item" href="blog-card-right-sidebar.html">Card Right Sidebar</a><a class="dropdown-item" href="blog-card-left-sidebar.html">Card Left Sidebar</a><a class="dropdown-item" href="blog-card-three-col.html">Card Three Col</a><a class="dropdown-item" href="blog-card-two-col-right-sidebar.html">Card two Col Right Sidebar</a><a class="dropdown-item" href="blog-card-two-col-left-sidebar.html">Card two Col Left Sidebar</a><a class="dropdown-item" href="blog-single-post.html">Single Post</a><a class="dropdown-item" href="blog-single-post-gallery.html">Single Gallary Post </a><a class="dropdown-item" href="blog-single-post-video.html">Single Video Post</a><a class="dropdown-item" href="blog-single-post-audio.html">Single Audio Post</a></div>
                                                    </li> -->
                            {{-- <li class="nav-item dropdown mega_menu_holder"><a class="dropdown-toggle nav-link"
                                    href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Booking</a>
                                <div class="dropdown-menu"><a class="dropdown-item"
                                        href="page-property-list.html">Booking
                                        Kamar</a><a class="dropdown-item" href="property-single.html">Detail Kamar</a>
                                </div>
                            </li> --}}
                            <!-- <li class="nav-item"><a class="nav-link" href="element-accordions.html">Element</a></li> -->
                            {{-- <li class="nav-item"><a class="nav-link" href="page-riwayat.html">Riwayat</a></li> --}}
                        </ul>
                        <ul class="nav-modules">
                            <!-- Login-->
                            <li class="nav-item" style="list-style: none"><a class="nav-link" href="login">Login</a>
                            </li>
                        </ul>
                        <ul class="nav-modules">
                            <!-- Login-->
                            <li class="nav-item" style="list-style: none"><a class="nav-link btn btn-primary"
                                    href="register">Register</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    @endif
@endsection
{{-- NAVBAR END --}}
