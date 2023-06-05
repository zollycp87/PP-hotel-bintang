@extends('layouts.main-admin')
@section('content')
    @if (Route::currentRouteName() == 'booking.create')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Menambah Data Pesanan</h5>
                <br>
                <form action="{{ route('booking.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4" hidden>
                            <input type="text" name="invoice" id="invoice" value="{{ $invoice }}">
                            <input type="text" name="id_customer" id="id_customer" value="{{ $id_customer }}">
                            <input type="text" name="status" id="status" value="{{ 'Unregister' }}">
                            <input type="text" name="status_booking" id="status" value="{{ 'Booking' }}">
                        </div>
                        <div class="col-12">
                            <label for="nama" class="form-label">Atas Nama</label>
                            <input type="text" class="form-control mb-1 @error('nama') is-invalid @enderror"
                                id="nama" name="nama" value="" placeholder="">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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
                                id="jumlah_kamar" name="jumlah_kamar" value="" placeholder="">
                            @error('jumlah_kamar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="no_kamar" class="form-label">Pilih Kamar</label>
                            <select class="form-select mb-1" aria-label="Default select example" name="no_kamar[]"
                                id="no_kamar" multiple size="">
                                {{-- <option disabled selected>Pilih No Kamar</option> --}}
                                @foreach ($kamar as $item)
                                    <option value="{{ $item->no_kamar }}" data-kategori="{{ $item->id_kategori }}"
                                        data-kamar="{{ $item->no_kamar }}">
                                        {{ $item->no_kamar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="jumlah_hari" class="form-label">Lama Hari</label>
                            <input type="number" class="form-control mb-1 @error('jumlah_hari') is-invalid @enderror"
                                id="jumlah_hari" name="jumlah_hari" value="" placeholder="">
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
                        <div class="col-12">
                            <label for="harga" class="form-label">Total Harga</label>
                            <input type="number" class="form-control mb-1" id="harga" name="harga" value=""
                                placeholder="">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button> |
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
            </div>
            </form><!-- Vertical Form -->
            {{-- END --}}
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Mengubah Data Kamar</h5>
                <br>
                @include('komponen.pesan')
                <form action="{{ route('kelola-kamar.update', $data->no_kamar) }}" method="post" class="row g-3"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                                <label for="no_kamar" class="form-label">No Kamar</label>
                                <input type="text" class="form-control mb-1" id="no_kamar" name="no_kamar"
                                    maxlength="6" value="{{ $data->no_kamar }}" placeholder=""
                                    aria-label="Disabled input example" readonly>
                            </div>
                            <div class="col-12">
                                <label for="id_kategori" class="form-label">Pilih Kategori Kamar</label>
                                <select class="form-select mb-1" aria-label="Default select example" name="id_kategori"
                                    id="id_kategori">
                                    {{-- <option disabled value>Pilih Jenis Paket</option> --}}
                                    <option selected value="{{ $data->id_kategori }}">
                                        {{ $data->kategori->nama_kategori }}
                                    </option>
                                    @foreach ($kategori as $item)
                                        @if ($item->id_kategori !== $data->id_kategori)
                                            <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="status" class="form-label">Status Kamar</label>
                                <select class="form-select" id="status" name="status">
                                    <option selected disabled value>Pilih Status Kamar</option>
                                    <option value="1"{{ $data->status == 'Ready' ? 'selected' : '' }}>Ready</option>
                                    <option value="2"{{ $data->status == 'Booked' ? 'selected' : '' }}>Booked
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button> |
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
            </div>
            </form><!-- Vertical Form -->
            {{-- END --}}
        </div>
    @endif
    <script>
        $(document).ready(function() {
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
        });
    </script>
@endsection
@section('sidebar')
    @include('sidebar-admin')
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // $('.my-select').selectpicker();

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

                                // Set nilai total harga ke input harga
                                $('#harga').val(totalHarga);
                            });
                        },
                        error: function() {
                            console.log('Terjadi kesalahan.');
                        }
                    });


                } else {
                    $('#no_kamar option').prop('disabled', false);
                }

                // Ambil elemen-elemen yang diperlukan
                var kategoriSelect = document.getElementById('id_kategori');
                var jumlahKamarInput = document.getElementById('jumlah_kamar');
                var noKamarSelect = document.getElementById('no_kamar');

                // Fungsi untuk mengubah opsi pada select no_kamar berdasarkan kategori yang dipilih
                function updateNoKamarOptions() {
                    var kategori = kategoriSelect.value;
                    var jumlahKamar = jumlahKamarInput.value;
                    var maxOptions = noKamarSelect.options.length;

                    // Menghapus pesan error sebelumnya (jika ada)
                    var errorElement = document.getElementById('error_message');
                    if (errorElement) {
                        errorElement.remove();
                    }

                    // Hapus semua opsi sebelumnya
                    while (noKamarSelect.options.length > 0) {
                        noKamarSelect.remove(0);
                    }

                    // Tambahkan opsi yang sesuai dengan kategori dan jumlah kamar yang dipilih
                    var addedOptions = 0;
                    @foreach ($kamar as $item)
                        if (kategori === "{{ $item->id_kategori }}" && jumlahKamar > 0) {
                            var option = document.createElement('option');
                            option.value = "{{ $item->no_kamar }}";
                            option.text = "{{ $item->no_kamar }}";
                            noKamarSelect.add(option);
                            jumlahKamar--;
                            addedOptions++;
                        }
                    @endforeach

                    // Tampilkan pesan error jika jumlah kamar yang diminta melebihi jumlah opsi yang tersedia
                    if (jumlahKamar > 0 && addedOptions === 0) {
                        var errorElement = document.getElementById('error_jumlah_kamar');
                        errorElement.innerText =
                            'Jumlah kamar yang diminta melebihi jumlah kamar yang tersedia.';
                        jumlahKamarInput.classList.add('is-invalid');
                    } else {
                        var errorElement = document.getElementById('error_jumlah_kamar');
                        errorElement.innerText = '';
                        jumlahKamarInput.classList.remove('is-invalid');
                    }
                }
                // Panggil fungsi updateNoKamarOptions saat kategori atau jumlah kamar berubah
                kategoriSelect.addEventListener('change', updateNoKamarOptions);
                jumlahKamarInput.addEventListener('input', updateNoKamarOptions);

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


        });
    </script>
@endsection
