@extends('layouts.main-admin')
@section('content')
    @if (Route::currentRouteName() == 'booking.create')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Menambah Data Pesanan</h5>
                <br>
                <form id="formSimpan" action="{{ route('booking.store') }}" method="post" class="row g-3"
                    enctype="multipart/form-data" onsubmit="return confirm('PASTIKAN PESANAN SUDAH BENAR!!')">
                    @csrf
                    <div class="row">
                        <div class="col-4" hidden>
                            <input type="text" name="id_customer" id="id_customer" value="{{ $id_customer }}">
                            <input type="text" name="invoice" id="invoice" value="{{ $invoice }}">
                            <input type="text" name="id_user" id="id_user" value="{{ Auth::user()->id_user }}">
                            <input type="text" name="status" id="status" value="{{ 'Offline' }}">
                            <input type="text" name="status_booking" id="status" value="{{ 'Booking' }}">
                        </div>
                        <div class="col-12">
                            <label for="nama" class="form-label">Atas Nama</label>
                            <input type="text" class="form-control mb-1 @error('nama') is-invalid @enderror"
                                id="nama" name="nama" value="{{ old('nama') }}" placeholder="">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="jumlah_hari" class="form-label">Lama Hari</label>
                            <input type="number" class="form-control mb-1 @error('jumlah_hari') is-invalid @enderror"
                                id="jumlah_hari" name="jumlah_hari" value="{{ old('jumlah_hari') }}" placeholder="">
                            @error('jumlah_hari')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="start_date" class="form-label">Tanggal mulai</label>
                            <input type="date" class="form-control mb-1 @error('nama') is-invalid @enderror"
                                id="start_date" name="start_date" value="" placeholder="">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="end_date" class="form-label">Tanggal akhir</label>
                            <input type="date" class="form-control mb-1" id="end_date" name="end_date" value=""
                                placeholder="">
                        </div>

                        {{-- <div class="col-3 mt-4" hidden>
                            <button type="button" id="filterData" class="btn btn-primary"><i class="bi bi-funnel me-1"></i>
                                Lihat Kamar Ready</button>
                        </div> --}}

                        <div class="col-4">
                            <label for="id_kategori" class="form-label">Pilih Kategori Kamar</label>
                            <select class="form-select mb-1" aria-label="Default select example" name="id_kategori"
                                id="id_kategori">
                                <option selected disabled value>Pilih Jenis Paket</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id_kategori }}" data-harga="{{ $item->harga }}">
                                        {{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="jumlah_kamar" class="form-label">Jumlah Kamar Yang Dipesan</label>
                            <input type="number" class="form-control mb-1 @error('jumlah_kamar') is-invalid @enderror"
                                id="jumlah_kamar" name="jumlah_kamar" value="{{ old('jumlah_kamar') }}" placeholder="">
                            @error('jumlah_kamar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- SELECT PILIH KAMAR --}}
                        <div class="col-4">
                            <label for="no_kamar" class="form-label">Pilih Kamar</label>
                            <div class="kamarContainer">
                                <select class="form-select mb-1" aria-label="Default select example" name="no_kamar[]"
                                    id="no_kamar" multiple size="">
                                    {{-- <option disabled selected>Pilih No Kamar</option> --}}
                                    @foreach ($kamar as $item)
                                        <option selected value="{{ $item->no_kamar }}"
                                            data-kategori="{{ $item->id_kategori }}" data-kamar="{{ $item->no_kamar }}">
                                            {{ $item->no_kamar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- SELECT PILIH KAMAR END --}}

                        <div class="col-6">
                            <label for="status_bayar" class="form-label">Pilih Status Bayar</label>
                            <select class="form-select mb-1" aria-label="Default select example" name="status_bayar"
                                id="status_bayar">
                                <option selected disabled value>Pilih Jenis Status Bayar</option>
                                <option value="1">Full Payment</option>
                                <option value="2">DP</option>
                                <option value="3" disabled>Pelunasan</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="harga" class="form-label">Total Harga</label>
                            <input type="number" class="form-control mb-1" id="harga" name="harga"
                                value="" placeholder="">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="mainSubmitButton" class="btn btn-primary">Simpan</button> |
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
            {{-- END --}}
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Menambah Data Pesanan</h5>
                <br>
                <form id="formSimpan" action="{{ route('booking.update', $data->invoice) }}" method="post"
                    class="row g-3" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-4" hidden>
                            <input type="text" name="invoice" id="invoice" value="{{ $data->invoice }}">
                            <input type="text" name="id_customer" id="id_customer" value="{{ $data->id_customer }}">
                            <input type="text" name="id_user" id="id_user" value="{{ $data->id_customer }}">
                            <input type="text" name="status" id="status" value="{{ 'Offline' }}">
                        </div>
                        <div class="col-12">
                            <label for="nama" class="form-label">Atas Nama</label>
                            <input type="text" class="form-control mb-1 @error('nama') is-invalid @enderror"
                                id="nama" name="nama" value="{{ $data->customer->nama }}" placeholder=""
                                readonly>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4" hidden>
                            <label for="jumlah_hari" class="form-label">Lama Hari</label>
                            <input type="number" class="form-control mb-1 @error('jumlah_hari') is-invalid @enderror"
                                id="jumlah_hari" name="jumlah_hari" value="{{ old('jumlah_hari') }}" placeholder="">
                            @error('jumlah_hari')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="start_date" class="form-label">Tanggal mulai</label>
                            <input type="date" class="form-control mb-1 @error('nama') is-invalid @enderror"
                                id="start_date" name="start_date" value="{{ $data->start_date }}" placeholder=""
                                readonly>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="end_date" class="form-label">Tanggal akhir</label>
                            <input type="date" class="form-control mb-1" id="end_date" name="end_date"
                                value="{{ $data->end_date }}" placeholder="" readonly>
                        </div>

                        {{-- <div class="col-3 mt-4" hidden>
                        <button type="button" id="filterData" class="btn btn-primary"><i class="bi bi-funnel me-1"></i>
                            Lihat Kamar Ready</button>
                    </div> --}}

                        <div class="col-4">
                            <label for="id_kategori" class="form-label">Pilih Kategori Kamar</label>
                            <select class="form-select mb-1" aria-label="Default select example" name="id_kategori"
                                id="id_kategori" disabled>
                                <option selected value>
                                    @foreach ($details->groupBy('id_kategori') as $idKategori => $detailsByKategori)
                                        @foreach ($detailsByKategori->unique('id_kategori') as $detail)
                                            {{ \App\Models\KategoriKamar::find($idKategori)->nama_kategori }}
                                        @endforeach
                                    @endforeach
                                </option>
                            </select>
                        </div>

                        <div class="col-4">
                            <label for="jumlah_kamar" class="form-label">Jumlah Kamar Yang Dipesan</label>
                            <input type="number" class="form-control mb-1 @error('jumlah_kamar') is-invalid @enderror"
                                id="jumlah_kamar" name="jumlah_kamar" value="{{ $details->count() }}" placeholder=""
                                readonly>
                            @error('jumlah_kamar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- SELECT PILIH KAMAR --}}
                        <div class="col-4">
                            <label for="no_kamar" class="form-label">Pilih Kamar</label>
                            <div class="kamarContainer">
                                <select class="form-select mb-1" aria-label="Default select example" name="no_kamar[]"
                                    id="no_kamar" multiple size="" disabled>
                                    {{-- <option disabled selected>Pilih No Kamar</option> --}}
                                    @foreach ($details as $item)
                                        <option value="{{ $item->no_kamar }}" data-kategori="{{ $item->id_kategori }}"
                                            data-kamar="{{ $item->no_kamar }}">
                                            {{ $item->no_kamar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- SELECT PILIH KAMAR END --}}

                        @if (count($data->detailBayar) == 1)
                            @foreach ($data->detailBayar as $item)
                                <div class="col-6">
                                    <label for="status_bayar" class="form-label">Pilih Status Bayar</label>
                                    <select class="form-select mb-1" aria-label="Default select example"
                                        name="status_bayar" id="status_bayar" disabled>
                                        <option
                                            value="1"{{ $item->status_bayar == 'Full Payment' ? 'selected' : '' }}>
                                            Full Payment</option>
                                        <option value="2"{{ $item->status_bayar == 'DP' ? 'selected' : '' }}>DP
                                        </option>
                                        <option value="3"{{ $item->status_bayar == 'Pelunasan' ? 'selected' : '' }}>
                                            Pelunasan</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="harga" class="form-label">Total Harga</label>
                                    <input type="number" class="form-control mb-1" id="harga" name="harga"
                                        value="{{ $item->total_bayar }}" placeholder="" readonly>
                                </div>
                                @if ($item->status_bayar == 'DP' && $data->status_booking !== 'New')
                                    <div class="col-6 mt-2">
                                        @php($pelunasan = $item->total_bayar * 4 - $item->total_bayar)
                                        <input type="text" class="form-control mb-2" id="status_pelunasan"
                                            name="status_pelunasan" value="Pelunasan" placeholder="" hidden>
                                        <label for="pelunasan" class="form-label">Biaya Pelunasan</label>
                                        <input type="number" class="form-control mb-2" id="pelunasan" name="pelunasan"
                                            value="{{ $pelunasan }}" placeholder="" readonly>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            @foreach ($data->detailBayar as $item)
                                <div class="col-6">
                                    <label for="status_bayar" class="form-label">Pilih Status Bayar</label>
                                    <select class="form-select mb-1" aria-label="Default select example"
                                        name="status_bayar" id="status_bayar" disabled>
                                        <option
                                            value="1"{{ $item->status_bayar == 'Full Payment' ? 'selected' : '' }}>
                                            Full Payment</option>
                                        <option value="2"{{ $item->status_bayar == 'DP' ? 'selected' : '' }}>DP
                                        </option>
                                        <option value="3"{{ $item->status_bayar == 'Pelunasan' ? 'selected' : '' }}>
                                            Pelunasan</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="harga" class="form-label">Total Harga</label>
                                    <input type="number" class="form-control mb-1" id="harga" name="harga"
                                        value="{{ $item->total_bayar }}" placeholder="" readonly>
                                </div>
                            @endforeach
                        @endif


                        <div class="col-12">
                            <label for="status_booking" class="form-label">Status Kamar</label>
                            <select class="form-select" id="status_booking" name="status_booking">
                                <option value="1"{{ $data->status_booking == 'New' ? 'selected' : '' }}>New
                                </option>
                                <option value="2"{{ $data->status_booking == 'Booking' ? 'selected' : '' }}>
                                    Booking
                                </option>
                                <option value="3"{{ $data->status_booking == 'Check In' ? 'selected' : '' }}>
                                    Check In
                                </option>
                                <option value="4"{{ $data->status_booking == 'Check Out' ? 'selected' : '' }}>
                                    Check
                                    Out</option>
                                <option value="5"{{ $data->status_booking == 'Cancel' ? 'selected' : '' }}>Cancel
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="mainSubmitButton" class="btn btn-primary">Simpan</button> |
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
            {{-- END --}}
        </div>
    @endif
@endsection

@section('sidebar')
    @include('sidebar-admin')
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            });

            $('#id_kategori').change(function() {
                var idKategori = $(this).val();

                if (idKategori) {
                    // Menghapus opsi yang tidak sesuai dengan kategori yang dipilih
                    $('#no_kamar option').each(function() {
                        var kategoriKamar = $(this).data('kategori');
                        if (kategoriKamar != idKategori) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });
                    // Mengatur ulang opsi yang dipilih
                    $('#no_kamar').val(null);

                    $.ajax({
                        url: "{{ route('get.harga', ':idKategori') }}".replace(':idKategori',
                            idKategori),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var hargaPerKamar = data.harga;

                            // Tampilkan harga di input harga
                            $('#harga').val(hargaPerKamar);

                            // Ubah input harga otomatis saat jumlah_kamar atau jumlah_hari berubah
                            $('#jumlah_kamar, #jumlah_hari').on('input', function() {
                                var jumlahKamar = $('#jumlah_kamar').val();
                                var jumlahHari = $('#jumlah_hari').val();

                                // Hitung total harga
                                var totalHarga = hargaPerKamar * jumlahKamar *
                                    jumlahHari;

                                $('#harga').val(totalHarga);

                                $('#status_bayar').change(function() {
                                    var statusBayar = $(this).val();
                                    var lastHarga = 0;

                                    if (statusBayar) {
                                        if (statusBayar == 1) {
                                            lastHarga = totalHarga;
                                        } else if (statusBayar == 2) {
                                            lastHarga = totalHarga / 4;
                                        }
                                    }
                                    $('#harga').val(lastHarga);
                                });
                            });
                        },
                        error: function() {
                            console.log('Terjadi kesalahan.');
                        }
                    });


                } else {
                    $('#no_kamar option').prop('disabled', false);
                }
            });

            $('#jumlah_hari, #start_date').change(function() {
                var jumlahHari = $('#jumlah_hari').val();
                var startDate = $('#start_date').val();

                if (jumlahHari && startDate) {
                    // Menghitung tanggal akhir berdasarkan lama hari dan tanggal mulai
                    var endDate = new Date(startDate);
                    endDate.setDate(endDate.getDate() + parseInt(jumlahHari));

                    // Mengubah format tanggal menjadi YYYY-MM-DD untuk input date
                    var formattedEndDate = endDate.toISOString().split('T')[0];

                    // Mengatur nilai input end_date
                    $('#end_date').val(formattedEndDate);
                }
            });

            $('#start_date, #end_date').change(function() {
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();

                if (startDate && endDate) {
                    // Menghitung lama hari berdasarkan tanggal mulai dan tanggal akhir
                    var start = new Date(startDate);
                    var end = new Date(endDate);
                    var diff = Math.floor((end - start) / (1000 * 60 * 60 * 24));

                    // Mengatur nilai input jumlah_hari
                    $('#jumlah_hari').val(diff);
                }
            });

            $('#start_date, #end_date, #id_kategori, #jumlah_kamar').change(function() {
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();
                var idKategori = $('#id_kategori').val();
                var jumlahKamar = $('#jumlah_kamar').val();

                if (startDate && endDate && idKategori) {
                    // Menghitung lama hari berdasarkan tanggal mulai dan tanggal akhir
                    var start = new Date(startDate);
                    var end = new Date(endDate);
                    // var diff = Math.floor((end - start) / (1000 * 60 * 60 * 24));

                    // // Mengatur nilai input jumlah_hari
                    // $('#jumlah_hari').val(diff);

                    // Mengambil jumlah kamar yang tersedia berdasarkan id_kategori
                    $.ajax({
                        url: '/cust/get-available-rooms',
                        method: 'POST',
                        data: {
                            start_date: startDate,
                            end_date: endDate,
                            id_kategori: idKategori
                        },
                        success: function(response) {
                            // Menampilkan jumlah kamar yang tersedia
                            var jumlahKamarReady = response.jumlah_kamar_ready;
                            $('#kamarReady').val(jumlahKamarReady);

                            // Menampilkan opsi kamar tersedia
                            var kamarTersedia = response.kamar_tersedia;
                            var selectNoKamar = $('#no_kamar');
                            selectNoKamar.empty();
                            var jumlahKamar = parseInt($('#jumlah_kamar').val());

                            // Memastikan jumlah opsi yang sesuai dengan jumlah_kamar yang diinputkan
                            for (var noKamar in kamarTersedia) {
                                var namaKamar = kamarTersedia[noKamar];
                                var option = $('<option>').val(noKamar).text(noKamar);
                                selectNoKamar.append(option);
                            }

                            // Memastikan jumlah opsi yang terpilih sesuai dengan jumlah_kamar yang diinputkan
                            selectNoKamar.find('option').slice(0, jumlahKamar).prop('selected',
                                true);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    // Reset the value of kamarReady input when any of the required fields is empty
                    $('#kamarReady').val('Kosong');
                }
            });
        });
    </script>
@endsection
