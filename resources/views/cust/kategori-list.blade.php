@extends('layouts.main-cust')

@section('content')
    @if (Auth::check())
        <p>HAI</p>
    @else
        <article class="entry">
            <div class="entry-content">
                <!-- Hero-->
                <div class="bg-cornflower-blue">
                    <div class="container">
                        <div class="py-lg-8 py-md-7 py-6">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <div class="text-center">
                                        <h1 class="mb-3 text-white mt-n1">BOOKING KAMAR</h1>
                                        <div class="pt-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- properties-->
                <div class="container my-lg-8 my-md-7 my-6">
                    <div class="row gx-lg-5 property-block">
                        @foreach ($kategoris as $kategori)
                            <div class="col-lg-4">
                                <article class="property-item">
                                    <div class="content-image"><a href="property-single.html"><img
                                                src="{{ url('foto') . '/' . $kategori->img }}" alt="property"></a></div>
                                    <h5 class="content-title"><a href="property-single.html">{{ $kategori->nama_kategori }}</a></h5>
                                    <div class="content-price">Rp.150.000</div><span class="content-meta"><span
                                            class="pr-3"><i class="fas fa-ruler-combined pr-3"> </i>Kipas Angin &
                                            TV</span>|
                                        <span class="px-3"><i class="fas fa-bed pr-3"> </i>2 Tempat Tidur</span>|<span
                                            class="pl-3"><i class="fas fa-bath pr-3"> </i>1 Kamar Mandi</span></span>
                                </article>
                            </div>
                        @endforeach
                    </div>
                    {{-- <div class="row gx-lg-5 property-block">
                        <div class="col-lg-4">
                            <article class="property-item">
                                <div class="content-image"><a href="property-single.html"><img
                                            src="assets/images/property/pf4.jpg" alt="property"></a></div>
                                <h5 class="content-title"><a href="property-single.html">Paket D</a></h5>
                                <div class="content-price">Rp.300.000</div><span class="content-meta"><span
                                        class="pr-3"><i class="fas fa-ruler-combined pr-3"> </i>AC & TV + Sarapan</span>|
                                    <span class="px-3"><i class="fas fa-bed pr-3"> </i>1 Tempat Tidur(Queen)</span>|<span
                                        class="pl-3"><i class="fas fa-bath pr-3"> </i>1 Kamar Mandi
                                        WaterHeater</span></span>
                            </article>
                        </div>
                    </div> --}}
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
                                    </div><a class="btn btn-white text-cornflower-blue" href="booking.html">Booking now</a>
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
