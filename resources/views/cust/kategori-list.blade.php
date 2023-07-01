@extends('layouts.main-cust')

@section('content')
    <article class="entry">
        <div class="entry-content">
            <!-- Hero-->
            <div class="bg-cornflower-blue">
                <div class="container">
                    <div class="py-lg-8 py-md-7 py-6">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="text-center">
                                    <h1 class="mb-3 text-white mt-n1">KATEGORI KAMAR</h1>
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
                        <div class="col-lg-4 mb-5">
                            <article class="property-item">
                                <div class="content-image"><img src="{{ url('foto') . '/' . $kategori->img }}"
                                        alt="property" style="width: 375px; height: 300px;">
                                </div>
                                <h5 class="content-title"><a
                                        href="{{ route('detail-kategori', $kategori->id_kategori) }}">{{ $kategori->nama_kategori }}</a>
                                </h5>
                                <div class="content-price">Rp{{ number_format($kategori->harga_kategori, 0, '.', ',') }}
                                </div>
                                <span class="content-meta">
                                    {{ $kategori->deskripsi }}
                                </span>
                            </article>
                        </div>
                    @endforeach
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
                                </div>
                                @if (Auth::check())
                                    <a class="btn btn-primary" href="{{ route('cust-booking') }}">Booking Now</a>
                                @else
                                    <a class="btn btn-primary" href="{{ route('login') }}">Booking Now</a>
                                @endif
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
