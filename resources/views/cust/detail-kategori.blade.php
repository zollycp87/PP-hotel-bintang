@extends('layouts.main-cust')

@section('content')
    <article class="entry">
        <div class="entry-content">
            <!-- Project featured img-->
            <div class="container">
                <div class="container position-relative">
                    <div class="container mt-5 pt-4">
                        <div class="row">
                            <div class="container">
                                <div class="my-lg-2 my-md-7 my-6">
                                    <div class="row gx-lg-5 property-block">
                                        <div class="content-image col-lg-6 mb-lg-0 mb-md-5 mb-5 order-lg-1">
                                            <img src="{{ url('foto') . '/' . $data->img }}" alt="gambar-detail-kamar">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-0 col-6">
                                                <article class="property-item">
                                                    <h2 class="content-title"><a
                                                            href="booking.html">{{ $data->nama_kategori }}</a></h2>
                                                    <div class="content-price">
                                                        <h3 style="color: #6246F9;">
                                                            Rp{{ number_format($data->harga_kategori, 0, '.', ',') }}</h3>
                                                    </div>
                                                    <p>
                                                        {{ $data->deskripsi }}
                                                        <br>
                                                        Kapasitas Maksimum : {{ $data->kapasitas }} orang
                                                        <br>
                                                        @php($jumlah = $jumlahKamarReady[$data->id_kategori] ?? 0)
                                                        Kamar Tersedia Hari Ini : {{ $jumlah }} kamar
                                                    </p>
                                                    <div class="text-center mt-5">
                                                        <div>
                                                            @if (Auth::check())
                                                                <a class="btn btn-primary"
                                                                    href="{{ route('cust-booking') }}">BOOKING NOW</a>
                                                            @else
                                                                <a class="btn btn-primary" href="{{ route('login') }}">BOOKING NOW</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
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
