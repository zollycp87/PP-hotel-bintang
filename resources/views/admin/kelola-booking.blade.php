@extends('layouts.main-admin')
@section('content')
    <div class="pagetitle">
        <h1>Kelola Data Booking</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Kelola Data Booking</li>
                <li class="breadcrumb-item active">Data Booking</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title d-flex justify-content-start">Data Booking</h5>
                <h5 class="card-title d-flex justify-content-end">
                    <a href="{{ route('booking.create') }}" type="button" class="btn btn-primary"><i
                            class="bi bi-plus me-1"></i> Tambah Data</a>
                </h5>
            </div>
            @include('komponen.pesan')

            <form action="{{ route('booking.filter') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-4">
                        {{-- <label for="booking-date" class="form-label">Filter Tanggal</label> --}}
                        @if (Route::currentRouteName() == 'booking.filter')
                            <input type="date" class="form-control mb-1 @error('booking-date') is-invalid @enderror"
                                id="booking-date" name="booking-date" value="{{ $bookingDate }}" placeholder="">
                            @error('booking-date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @else
                            <input type="date" class="form-control mb-1 @error('booking-date') is-invalid @enderror"
                                id="booking-date" name="booking-date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                placeholder="">
                            @error('booking-date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-funnel me-1"></i></button>
                    </div>
                </div>
            </form>

            <!-- Bordered Table -->
            <table class="table table-bordered" id="booking">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        {{-- <th scope="col">Invoice</th> --}}
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Tanggal Pesan</th>
                        <th scope="col">Tanggal mulai</th>
                        <th scope="col">Tanggal selesai</th>
                        <th scope="col">Total Bayar</th>
                        <th scope="col">Status Bayar</th>
                        <th scope="col">Status Booking</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody id="bookingTable">
                    @php($nomor_urut = 1)
                    @forelse ($posts as $item)
                        <tr>
                            <th scope="row">{{ $nomor_urut++ }}</th>
                            {{-- <td>{{ substr($item->invoice, 0, 14) }}</td> --}}
                            <td>{{ $item->customer->nama }}</td>
                            <td>{{ $item->tanggal_pesan }}</td>
                            <td>{{ $item->start_date }}</td>
                            <td>{{ $item->end_date }}</td>
                            {{-- @dd($item->detailBayar) --}}
                            <td>
                                @foreach ($item->detailBayar as $detailBayar)
                                    Rp {{ number_format($detailBayar->total_bayar, 0, '.', ',') }}
                                @endforeach
                            </td>

                            <td>
                                @foreach ($item->detailBayar as $detailBayar)
                                    @if ($detailBayar->status_bayar == 'DP')
                                        <span class="badge text-bg-primary">DP</span>
                                    @elseif ($detailBayar->status_bayar == 'Pelunasan')
                                        <span class="badge text-bg-info">Pelunasan</span>
                                    @elseif ($detailBayar->status_bayar == 'Full Payment')
                                        <span class="badge text-bg-success">Full Payment</span>
                                    @endif
                                @endforeach
                            </td>

                            <td>
                                @if ($item->status_booking == 'New')
                                    <span class="badge text-bg-primary">New</span>
                                @elseif ($item->status_booking == 'Booking')
                                    <span class="badge text-bg-warning">Booking</span>
                                @elseif ($item->status_booking == 'Check In')
                                    <span class="badge text-bg-success">Check In</span>
                                @elseif ($item->status_booking == 'Check Out')
                                    <span class="badge text-bg-danger">Check Out</span>
                                @elseif ($item->status_booking == 'Cancel')
                                    <span class="badge text-bg-dark">Cancel</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-between">
                                    <button type="button" class="text-primary btn-details"
                                        style="border: none; background: transparent;" data-bs-toggle="modal"
                                        data-bs-target="#detailBooking{{ $item->invoice }}">Detail</button>
                                    |
                                    <a href="{{ route('booking.edit', $item->invoice) }}" class="text-secondary">Edit</a>
                                    |
                                    {{-- <form action="{{ route('booking.destroy', $item->invoice) }}" method="post"
                                        onsubmit="return confirm('Yakin akan menghapus data ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="submit" class="text-danger"
                                            style="border: none; background: transparent;">Hapus</button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data Belum Tersedia.
                        </div>
                    @endforelse
                </tbody>
            </table>
            <!-- End Bordered Table -->
        </div>
    </div>

    <!-- Modal Detail -->
    @foreach ($posts as $item)
        <div class="modal fade" id="detailBooking{{ $item->invoice }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $item->invoice }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalBodyDetail">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-12">
                                Status
                                @if ($item->status_booking == 'New')
                                    <span class="badge text-bg-primary">New</span>
                                @elseif ($item->status_booking == 'Booking')
                                    <span class="badge text-bg-warning">Booking</span>
                                @elseif ($item->status_booking == 'Check In')
                                    <span class="badge text-bg-success">Check In</span>
                                @elseif ($item->status_booking == 'Check Out')
                                    <span class="badge text-bg-danger">Check Out</span>
                                @elseif ($item->status_booking == 'Cancel')
                                    <span class="badge text-bg-dark">Cancel</span>
                                @endif
                            </h4>
                            <div class="mb-3">
                                <h3 class="mb-1 text-muted">Hotel Bintang</h3>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">Atas Nama:</h5>
                                    <h5 class="font-size-15 mb-2">{{ $item->customer->nama }}</h5>
                                    <p class="mb-1">Check In :
                                        {{ \Carbon\Carbon::parse($item->start_date)->format('j F Y') }}</p>
                                    <p class="mb-1">Check Out :
                                        {{ \Carbon\Carbon::parse($item->end_date)->format('j F Y') }}</p>
                                    @php($lamaHari = \Carbon\Carbon::parse($item->end_date)->diffInDays(\Carbon\Carbon::parse($item->start_date)))
                                    <p class="mb-1">Lama Hari :
                                        {{ $lamaHari }} Hari</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p>#{{ $item->invoice }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                        <p>{{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('j F Y') }}
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
                                            <th>Harga Kategori</th>
                                            <th>Jumlah Kamar</th>
                                            <th class="text-end" style="width: 120px;">Total</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @php($nomor_urut = 1)
                                        @php($total = 0)
                                        @php($totalKamar = 0)
                                        @foreach ($details as $detail)
                                            @if ($detail->invoice == $item->invoice)
                                                <tr>
                                                    <th scope="row">{{ $nomor_urut++ }}</th>
                                                    <td>{{ $detail->kategori->nama_kategori }}</td>
                                                    <td>Rp{{ number_format($detail->kategori->harga_kategori, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $detail->jumlah_kamar }}</td>
                                                    @php($totalKamar += $detail->jumlah_kamar)
                                                    <td hidden>
                                                        {{ $totalKategori = $detail->kategori->harga_kategori * $totalKamar * $lamaHari }}
                                                    </td>
                                                    <td class="text-end">
                                                        Rp{{ number_format($totalKategori, 0, '.', ',') }}
                                                    </td>
                                                    <td hidden>{{ $total += $totalKategori }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                            <td class="border-0 text-end">
                                                <h5 class="m-0 fw-semibold">Rp{{ number_format($total, 0, '.', ',') }}
                                                </h5>
                                            </td>
                                        </tr>
                                        <!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="printModalContent()">Print</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('sidebar')
    @include('sidebar-admin')
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#booking').DataTable();
        });

        function printModalContent() {
            var modalBodyContent = document.getElementById("modalBodyDetail").innerHTML;
            var printWindow = window.open('', '_blank', );
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Modal Body Content</title></head><body>');
            printWindow.document.write(modalBodyContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
@endsection
