@extends('layouts.main-cust')

@section('content')
    <style>
        hr {
            border: none;
            border-top: 1px solid rgba(0, 0, 0, 0.2);
            /* Warna abu-abu samar */
            margin: 10px 0;
            /* Jarak atas dan bawah */
        }
    </style>
    {{-- <div class="container-sm bg-primary d-flex justify-content-center mt-3 mb-3">
        <div class="col-8 bg-danger">
            <div class="card">
                <div class="card-body">
                    <div class="mr-3 ml-3 d-flex justify-content-between">
                        <h5 class="">Invoice</h5>
                        <h5>
                            <span class="badge badge-primary">New</span>
                        </h5>
                    </div>
                    <hr>
                    .
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container py-3 mb-5 h-100">
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
        <div class="row d-flex align-items-center h-100">
            @forelse ($posts as $item)
                <div class="col-md-10 col-lg-8 col-xl-6 mb-4">
                    <div class="card card-stepper" style="border-radius: 16px;">
                        <div class="card-header p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-2"> Invoice <span
                                            class="fw-bold text-body">{{ $item->invoice }}</span>
                                    </p>
                                    <p class="text-muted mb-0"><span
                                            class="fw-bold text-body">{{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('j F Y') }}</span>
                                    </p>
                                </div>
                                <div>
                                    <h6 class="mb-0" style="border-radius : 10px;">
                                        @if ($item->status_booking == 'New')
                                            <span class="pl-2 pr-2 bg-danger text-white"
                                                style="border-radius:10px;">Unverified</span>
                                        @elseif ($item->status_booking == 'Booking' || $item->status_booking == 'Check In')
                                            <span class="pl-2 pr-2 bg-success text-white"
                                                style="border-radius:10px;">Verified</span>
                                        @elseif ($item->status_booking == 'Check Out')
                                            <span class="pl-2 pr-2 bg-success text-white"
                                                style="border-radius:10px;">Selesai</span>
                                        @elseif ($item->status_booking == 'Cancel')
                                            <span class="pl-2 pr-2 bg-dark text-white"
                                                style="border-radius:10px;">Cancel</span>
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="d-flex flex-row mb-0 pb-2">
                                <div class="flex-fill">
                                    @foreach ($details as $detail)
                                        @if ($detail->invoice == $item->invoice)
                                            <h5 class="bold">{{ $detail->kategori->nama_kategori }}</h5>
                                            <p class="text-muted"> Qt: {{ $totalKamar = $detail->jumlah_kamar }} kamar</p>
                                            @php($lamaHari = \Carbon\Carbon::parse($item->end_date)->diffInDays(\Carbon\Carbon::parse($item->start_date)))
                                            @php($totalBayar = ($detail->kategori->harga_kategori * $totalKamar * $lamaHari) / 4)
                                            <h5 class="mb-1">Total DP : Rp{{ number_format($totalBayar, 0, '.', ',') }}
                                                <br>
                                                <h6>
                                                    @php($pelunasan = $detail->kategori->harga_kategori * $totalKamar * $lamaHari - $totalBayar)
                                                    <span class="small text-muted"> Pelunasan
                                                        Rp{{ number_format($pelunasan, 0, '.', ',') }} </span>
                                                    <br>
                                                    <span class="small text-muted"> (Dibayarkan saat check in) </span>
                                                </h6>
                                            </h5>
                                        @endif
                                    @endforeach
                                </div>
                                <div>
                                    {{-- <img class="align-self-center img-fluid"
                                        src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/6.webp"
                                        width="250"> --}}
                                    <p class="text-muted text-right">Check IN:
                                        <br>
                                        <span
                                            class="text-body">{{ \Carbon\Carbon::parse($item->start_date)->format('j F Y') }}</span>
                                    </p>
                                    <p class="text-muted text-right">Check Out:
                                        <br>
                                        <span
                                            class="text-body">{{ \Carbon\Carbon::parse($item->end_date)->format('j F Y') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer p-3">
                            <div class="d-flex justify-content-end">
                                <h6 class="fw-normal mb-0 mr-3"><a href="#!">Cancel</a></h6>
                                <h6 class="fw-normal mb-0"><a href="{{ route('cust.invoice', $item->invoice) }}">Detail</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger">
                    Data Belum Tersedia.
                </div>
            @endforelse
        </div>
    </div>
@endsection


{{-- NAVBAR --}}
@section('navbar')
    @include('navbar-cust')
@endsection
{{-- NAVBAR END --}}
