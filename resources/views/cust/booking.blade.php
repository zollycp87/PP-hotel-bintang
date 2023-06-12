@extends('layouts.main-cust')

@section('content')
    <!-- Booking Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Room Booking</h6>
                <h1 class="mb-5">Hotel <span class="text-primary text-uppercase">Bintang Flores</span></h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s"
                                src="{{ asset('customer/assets\images\singleproperty\1.jpg') }}" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s"
                                src="{{ asset('customer/assets\images\singleproperty\2.jpg') }}">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.5s"
                                src="{{ asset('customer/assets\images\singleproperty\3.jpg') }}">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s"
                                src="{{ asset('customer/assets\images\singleproperty\4.jpg') }}">
                        </div>
                    </div>
                </div>


                <div class="col-4" hidden>
                    <input type="text" name="invoice" id="invoice" value="{{ $invoice }}">
                    <input type="text" name="id_customer" id="id_customer" value="{{ Auth::user()->id_user }}">
                    <input type="text" name="status_booking" id="status" value="{{ 'New' }}">
                </div>

                <div class="col-lg-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <form id='form'>
                            <div class="row g-3">



                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <label for="nama">Nama Pemesan</label>
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            placeholder="Nama Lengkap" value="{{ Auth::user()->nama }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <label for="id_kategori" class="form-label">Pilih Kategori Kamar</label>
                                        <select class="form-select mb-1" aria-label="Default select example"
                                            name="id_kategori" id="id_kategori">
                                            <option selected disabled value>Pilih Jenis Paket</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id_kategori }}" data-harga="{{ $item->harga }}">
                                                    {{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <label for="jumlah_kamar" class="form-label">Jumlah Kamar Yang Dipesan</label>
                                        <input type="number" class="form-control mb-1 @error('jumlah_kamar') is-invalid @enderror"
                                            id="jumlah_kamar" name="jumlah_kamar" value="" placeholder="">
                                        @error('jumlah_kamar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <label for="checkin">Check In</label>
                                        <br>
                                        <input class="form-control datetimepicker-input" type="date" id="checkin"
                                            data-target="#date3" data-toggle="datetimepicker" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <label for="checkout">Check Out</label>
                                        <br>
                                        <input class="form-control datetimepicker-input" type="date" id="checkout"
                                            data-target="#date4" data-toggle="datetimepicker" />
                                    </div>
                                </div> --}}

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <label for="jumlah_hari" class="form-label">Lama Hari</label>
                                        <input type="number" class="form-control mb-1 @error('jumlah_hari') is-invalid @enderror"
                                            id="jumlah_hari" name="jumlah_hari" value="" placeholder="">
                                        @error('jumlah_hari')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating date">
                                        <label for="start_date" class="form-label">Check In</label>
                                        <input type="date" class="form-control mb-1 @error('start_date') is-invalid @enderror"
                                            id="start_date" name="start_date" value="" placeholder="">
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating date">
                                        <label for="end_date" class="form-label">Check Out</label>
                                        <input type="date" class="form-control mb-1" id="end_date" name="end_date" value=""
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <label for="harga" class="form-label">Total Harga ( Membayar DP 25% )</label>
                                        <input type="number" class="form-control mb-1" id="harga" name="harga" value=""
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox"
                                            value="" id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">I agree and accept the 
                                            <a href="#">terms and conditions</a></label>
                                        <div class="invalid-feedback">Setujui layanan kami untuk melanjutkan</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                function validateNumberInput(event) {
                    var input = event.target;
                    if (input.value < 1) {
                        input.value = Math.abs(input.value);
                    }
                }
            </script>

        </div>
    </div>
    <!-- Booking End -->
@endsection

{{-- NAVBAR --}}
@section('navbar')
    @include('navbar-cust')
@endsection
{{-- NAVBAR END --}}

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
                        url: "{{ route('get.hargaCust', ':idKategori') }}".replace(':idKategori',
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
