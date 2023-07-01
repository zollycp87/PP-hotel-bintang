@extends('layouts.main-admin')
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">

                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}

                            <div class="card-body">
                                <h5 class="card-title">Booking <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ count($bookings) }}</h6>
                                        @if ($percenBooking < 0)
                                            <span class="text-danger small pt-1 fw-bold">{{ $percenBooking }}%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>
                                        @else
                                            <span class="text-success small pt-1 fw-bold">{{ $percenBooking }}%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card revenue-card">

                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}

                            <div class="card-body">
                                <h5 class="card-title">Pendapatan <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Rp {{ number_format($pendapatan, 0, '.', ',') }}</h6>
                                        @if ($percenPendapatan < 0)
                                            <span class="text-danger small pt-1 fw-bold">{{ $percenPendapatan }}%</span>
                                            <span class="text-muted small pt-2 ps-1">increase</span>
                                        @else
                                            <span class="text-success small pt-1 fw-bold">{{ $percenPendapatan }}%</span>
                                            <span class="text-muted small pt-2 ps-1">increase</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-4">

                        <div class="card info-card customers-card">

                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}

                            <div class="card-body">
                                <h5 class="card-title">Customers <span>| Check-In Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $customerCount }}</h6>
                                        {{-- <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">decrease</span> --}}
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon text-primary" href="{{ route('booking.index') }}">See More</a>
                                {{-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul> --}}
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                                <!-- Bordered Table -->
                                <table class="table table-bordered" id="booking">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            {{-- <th scope="col">Invoice</th> --}}
                                            <th scope="col">Nama Customer</th>
                                            <th scope="col">Tanggal Pesan</th>
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
                                                {{-- @dd($item->detailBayar) --}}
                                                <td>
                                                    @foreach ($item->detailBayar as $detailBayar)
                                                        Rp {{ number_format($detailBayar->total_bayar, 0, '.', ',') }}
                                                        <br>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @foreach ($item->detailBayar as $detailBayar)
                                                        @if ($detailBayar->status_bayar == 'DP')
                                                            <span class="badge text-bg-primary">DP</span>
                                                            @if ($detailBayar->bukti_bayar !== null && $detailBayar->bukti_bayar !== '-')
                                                                <button type="button" class="text-primary btn-details"
                                                                    style="border: none; background: transparent;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#buktibayar{{ $item->invoice }}">Bukti</button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="buktibayar{{ $item->invoice }}"
                                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5"
                                                                                    id="exampleModalLabel">Bukti Bayar
                                                                                    {{ $item->invoice }}
                                                                                </h1>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div
                                                                                    class="mb-3 d-flex justify-content-center">
                                                                                    <img src="{{ url('foto') . '/' . $detailBayar->bukti_bayar }}"
                                                                                        alt="" width="300px"
                                                                                        height="300px">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @elseif ($detailBayar->status_bayar == 'Pelunasan')
                                                            <br>
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
                                                            style="border: none; background: transparent;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#detailBooking{{ $item->invoice }}">Detail</button>
                                                        |
                                                        <a href="{{ route('booking.edit', $item->invoice) }}"
                                                            class="text-secondary">Edit</a>
                                                        |
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
                    </div><!-- End Recent Sales -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                {{-- <h5 class="card-title">Reports <span>/Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Booking',
                                                data: [31, 40, 28, 51, 42, 82, 56],
                                            }, {
                                                name: 'Pendapatan',
                                                data: [11, 32, 45, 32, 34, 52, 41]
                                            }, {
                                                name: 'Customers',
                                                data: [15, 11, 32, 18, 9, 24, 11]
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z",
                                                    "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z",
                                                    "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                                                    "2018-09-19T06:30:00.000Z"
                                                ]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart --> --}}

                            </div>

                        </div>
                    </div><!-- End Reports -->
                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>

    <!-- Modal Detail -->
    @foreach ($posts as $item)
        <div class="modal fade" id="detailBooking{{ $item->invoice }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            $('#booking').DataTable({
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "pageLength": 5
            });
        });
    </script>
@endsection
