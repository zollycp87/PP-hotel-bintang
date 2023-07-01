@extends('layouts.main-cust')

@section('content')
    <article class="entry">
        <div class="entry-content">
            <!--featured image-->
            <div class="container">
                <div class="row">
                    <div class="col-lg-9"><img src="{{ asset('customer/assets/images/about-us/dpn.jpeg') }}" alt="about-us">
                    </div>
                </div>
            </div>
            <!-- image design-->
            <div class="container">
                <div class="my-lg-8 my-md-7 my-6">
                    <div class="row gx-lg-5">
                        <div class="col-lg-6 mb-lg-0 mb-md-5 mb-5 order-lg-1"><img
                                src="{{ asset('customer/assets/images/about-us/hal.jpeg') }}" alt="about-us"></div>
                        <div class="col-lg-6">
                            <div class="pr-lg-9 pr-md-7 pr-6">
                                <h1 class="mb-lg-5">Hotel Bintang Flores</h1>
                            </div>
                            <div class="mb-4">
                                <p class="mb-4">Hotel Bintang Flores adalah penginapan Hotel bitnang 2 yang berada pada
                                    tempat yang stategis dan dengan harga yang terjangkau, alamat lengkap berada di </p>
                                <p class="mb-4">89, Jl. Flores No.3, Rejamulya, Gunungsimping, Kec. Cilacap Tengah,
                                    Kabupaten Cilacap, Jawa Tengah 53223.</p>
                                <blockquote>
                                    <div class="border-left-1 pl-4">
                                        <p>Mari menginap di Hotel Bintang Flores nikmati sensasi kenyamanan menginap di
                                            hotel kami dengan pelayanan hotel bintang 2 serta dengan harga yang terjangkau.
                                        </p>
                                        <cite class="font-weight-bold text-silver-chalice">Ponco Muji Astuti</cite>
                                    </div>
                                </blockquote>
                            </div>
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
                                        @if (Auth::check())
                                            <a class="btn btn-white text-cornflower-blue"
                                                href="{{ route('cust-booking') }}">Booking now</a>
                                        @else
                                            <a class="btn btn-white text-cornflower-blue" href="login">Booking now</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </article>
@endsection

{{-- NAVBAR --}}
@section('navbar')
    @include('navbar-cust')
@endsection
{{-- NAVBAR END --}}
