@extends('layouts.main-cust')

@section('content')
    @if (Auth::check())
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
                                        <div class="pr-lg-6 pr-md-6 ml-5">
                                            <h3 class="mt-3 mb-4 text-white">Selamat Datang</h3>
                                            <div class="pt-2">
                                                <p class="lead mb-4 text-white">Sambut Kedatangan Anda dengan Penuh
                                                    Kehangatan di Hotel Strategis dan Terjangkau</p>
                                            </div><a class="btn btn-white text-cornflower-blue mt-4"
                                                href="{{ route('cust-booking') }}">Book Now</a>
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
                                            alt="property" style="width: 375px; height: 300px;">
                                    </div>
                                    <h5 class="content-title"><a href="{{ route('detail-kategori', $kategori->id_kategori) }}">{{ $kategori->nama_kategori }}</a></h5>
                                    <div class="content-price">Rp{{ number_format($kategori->harga_kategori, 0, '.', ',') }}
                                    </div>
                                    <span class="content-meta">{{ $kategori->deskripsi }}</span>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="container text-center"><a class="btn btn-athens-gray text-ebonny-clay"
                        href="{{ route('kategori-list') }}">Lihat kamar lainnya</a></div>
                <!-- memeber-->
                <div class="container my-lg-9 my-md-7 my-5">
                    <div class="row gx-lg-0">
                        <div class="col-lg-6"><img src="{{ asset('customer/assets/images/home/h3.jpg') }}" alt="member"></div>
                        <div class="col-lg-6 mn-6 bg-livender my-auto">
                            <div class="py-lg-6 px-lg-6 py-md-6 px-md-5 py-5 px-4 ml-5"><i
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
                                        </div><a class="btn btn-white text-cornflower-blue" href="{{ route('cust-booking') }}">Booking now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    @else
        <article class="entry">
            <div class="entry-content">
                <!-- head title-->
                <div class="bg-cornflower-blue mb-lg-7">
                    <div class="pt-lg-5 d-flex align-items-center">
                        <div class="container mb-lg-5 ">
                            <div class="row d-flex">
                                <div class="col-lg-6 mn-7 order-lg-1">
                                    <img src="{{ asset('customer/assets/images/logo/logo.png') }}" alt="home">
                                </div>
                                <div class="col-lg-6 col-md-12 pb-lg-4 my-auto">
                                    <div class="mt-lg-0 mt-md-5 mt-4">
                                        <div class="pr-lg-6 pr-md-6 ml-5">
                                            <h3 class="mt-3 mb-4 text-white">Selamat Datang</h3>
                                            <div class="pt-2">
                                                <p class="lead mb-4 text-white">Sambut Kedatangan Anda dengan Penuh
                                                    Kehangatan di Hotel Strategis dan Terjangkau</p>
                                            </div><a class="btn btn-white text-cornflower-blue mt-4"
                                                href="login">Get Started</a>
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
                                            alt="property" style="width: 375px; height: 300px;">
                                    </div>
                                    <h5 class="content-title"><a href="">{{ $kategori->nama_kategori }}</a></h5>
                                    <div class="content-price">
                                        Rp{{ number_format($kategori->harga_kategori, 0, '.', ',') }}
                                    </div>
                                    <span class="content-meta">{{ $kategori->deskripsi }}</span>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="container text-center"><a class="btn btn-athens-gray text-ebonny-clay"
                        href="{{ route('kategori-list') }}">Lihat kamar lainnya</a></div>
                <!-- memeber-->
                <div class="container my-lg-9 my-md-7 my-5">
                    <div class="row gx-lg-0">
                        <div class="col-lg-6"><img src="{{ asset('customer/assets/images/home/h3.jpg') }}" alt="member"></div>
                        <div class="col-lg-6 mn-6 bg-livender my-auto">
                            <div class="py-lg-6 px-lg-6 py-md-6 px-md-5 py-5 px-4 ml-5"><i
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
    @include('navbar-cust')
@endsection
{{-- NAVBAR END --}}
