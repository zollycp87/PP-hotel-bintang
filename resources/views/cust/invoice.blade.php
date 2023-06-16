@extends('layouts.main-cust')

@section('content')
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    <div class="container mb-5">
        @include('komponen.pesan')
        @if ($data->status_booking == 'New')
            <div class="col-12 d-flex justify-content-between">
                <div class="col-8 bg-none mb-5" style="border: 1px solid black; padding: 10px;" role="alert">
                    <h4 class="alert-heading">Penting!</h4>
                    <p>Harap segera melakukan pembayaran menggunakan ATM BCA dengan nomor rekening acak berikut:</p>
                    <p><strong>Nomor Rekening: 1234-5678-9012</strong></p>
                    <p>Jangan lupa mengunggah bukti pembayaran setelah melakukan transfer.</p>
                    <p>Jika Anda melakukan pembayaran dan kemudian membatalkan, tidak akan ada pengembalian dana.</p>
                    <hr>
                    <p class="mb-0">Jika ada pertanyaan atau bantuan, silakan hubungi kami.</p>
                </div>
                {{-- <div class="col-4">
                    <div id="countdown"></div>
                </div> --}}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="invoice-title">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <h3 class="font-size-16">Hotel Bintang</h3>
                                </div>
                                <h5 class="float-end font-size-12">
                                    Status
                                    @if ($data->status_booking == 'New')
                                        <span class="pl-2 pr-2 bg-danger text-white"
                                            style="border-radius:10px;">Unverified</span>
                                    @elseif ($data->status_booking == 'Booking' || $data->status_booking == 'Check In')
                                        <span class="pl-2 pr-2 bg-success text-white"
                                            style="border-radius:10px;">Verified</span>
                                    @elseif ($data->status_booking == 'Check Out')
                                        <span class="pl-2 pr-2 bg-success text-white"
                                            style="border-radius:10px;">Selesai</span>
                                    @elseif ($data->status_booking == 'Cancel')
                                        <span class="pl-2 pr-2 bg-dark text-white" style="border-radius:10px;">Cancel</span>
                                    @endif
                                </h5>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-1">Atas Nama:</h5>
                                    <h5 class="font-size-15 mb-2">{{ $data->customer->nama }}</h5>
                                    <p class="mb-1">Check In :
                                        {{ \Carbon\Carbon::parse($data->start_date)->format('j F Y') }}</p>
                                    <p class="mb-1">Check Out :
                                        {{ \Carbon\Carbon::parse($data->end_date)->format('j F Y') }}</p>
                                    @php($lamaHari = \Carbon\Carbon::parse($data->end_date)->diffInDays(\Carbon\Carbon::parse($data->start_date)))
                                    <p class="mb-1">Lama Hari :
                                        {{ $lamaHari }} Hari</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-muted text-right">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p>#{{ $data->invoice }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                        <p>{{ \Carbon\Carbon::parse($data->created_at)->format('j F Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="py-2">
                            <h5 class="font-size-15">Detail Order</h5>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Kategori Kamar</th>
                                            <th>Harga Kategori (DP)</th>
                                            <th>Jumlah Kamar</th>
                                            <th class="text-end" style="width: 120px;">Total</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @php($nomor_urut = 1)
                                        @php($total = 0)
                                        @php($totalKamar = 0)
                                        @foreach ($details as $detail)
                                            @if ($detail->invoice == $data->invoice)
                                                <tr>
                                                    <th scope="row">{{ $nomor_urut++ }}</th>
                                                    <td>{{ $detail->kategori->nama_kategori }}</td>
                                                    <td>Rp{{ number_format($detail->kategori->harga_kategori / 4, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $detail->jumlah_kamar }}</td>
                                                    @php($totalKamar += $detail->jumlah_kamar)
                                                    <td hidden>
                                                        {{ $totalKategori = ($detail->kategori->harga_kategori * $totalKamar * $lamaHari) / 4 }}
                                                    </td>
                                                    <td class="text-right">
                                                        Rp{{ number_format($totalKategori, 0, '.', ',') }}
                                                    </td>
                                                    <td hidden>{{ $total += $totalKategori }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                            <td class="border-0 text-right">
                                                <h5 class="m-0 fw-semibold">Rp{{ number_format($total, 0, '.', ',') }}
                                                </h5>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">Pelunasan
                                                @if (count($bayarLunas) == 0)
                                                    <span class="pl-2 pr-2 bg-danger text-white"
                                                        style="border-radius:10px; font-size: 11px;"> Unpaid</span>
                                                @else
                                                    <span class="pl-2 pr-2 bg-success text-white"
                                                        style="border-radius:10px; font-size: 11px;"> Paid</span>
                                                @endif
                                            </th>
                                            <td class="border-0 text-right">
                                                <h5 class="m-0 fw-semibold">
                                                    Rp{{ number_format($total * 4 - $total, 0, '.', ',') }}
                                                </h5>
                                            </td>
                                        </tr>


                                        <!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div>
                    </div>
                </div>
            </div><!-- end invoice -->

            <div class="col-lg-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <h4 class="font-size-16">Upload Bukti Bayar</h4>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">
                        <form action="{{ route('cust-bukti-upload', $data->invoice) }}" method="post" class="row g-3"
                            enctype="multipart/form-data">
                            {{-- @include('komponen.pesan') --}}
                            @csrf
                            @method('PUT')
                            @foreach ($bayarDP as $bukti)
                                @if ($bukti->bukti_bayar)
                                    <div class="mb-3 d-flex justify-content-center">
                                        <img src="{{ url('foto') . '/' . $bukti->bukti_bayar }}" alt=""
                                            width="200px" height="200px">
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label for="img" class="form-label">Pilih Gambar</label>
                                    <input class="form-control" type="file" id="img" name="img">
                                </div>
                                @if ($data->status_booking == 'New')
                                    <button type="submit" id="mainSubmitButton" class="btn btn-primary">Unggah</button>
                                @endif
                            @endforeach
                        </form>

                    </div>
                </div><!-- end col -->
            </div>
        </div>
        @if ($data->status_booking == 'New' || $data->status_booking == 'Booking')
            <a href="{{ route('cust-cancel', $data->invoice) }}" id="cancel"
                class="btn btn-danger d-flex justify-content-center">Cancel Booking</a>
        @endif
    </div>
@endsection

{{-- NAVBAR --}}
@section('navbar')
    @include('navbar-cust')
@endsection
{{-- NAVBAR END --}}

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#cancel").on("click", function(e) {
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
                    title: 'Yakin Akan Membatalkan Pesanan?',
                    text: "Tidak Ada Refund Uang DP yang Sudah Dibayarkan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Batalkan Pesanan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Cancelled Order!',
                            'Pesanananmu Berhasil Dibatalkan',
                            'success'
                        );
                        // Redirect ke halaman pembatalan pesanan
                        window.location.href = link;
                    }
                })
            });
        });
    </script>
@endsection
