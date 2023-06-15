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

                <div class="col-lg-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">

                        <form id="formSimpan" action="{{ route('cust-create-booking') }}" method="post" class="row g-3"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-4" hidden>
                                <input type="text" name="invoice" id="invoice" value="{{ $invoice }}">
                                <input type="text" name="id_customer" id="id_customer" value="{{ Auth::user()->id_user }}">
                                <input type="text" name="status_booking" id="status_booking" value="{{ 'New' }}">
                                <input type="text" name="status_bayar" id="status_bayar" value="{{ 'DP' }}">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <label for="nama">Nama Pemesan</label>
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            placeholder="Nama Lengkap" value="{{ Auth::user()->nama }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <label for="jumlah_hari" class="form-label">Lama Hari</label>
                                        <input type="number"
                                            class="form-control mb-1 @error('jumlah_hari') is-invalid @enderror"
                                            id="jumlah_hari" name="jumlah_hari" value="{{ old('jumlah_hari') }}"
                                            placeholder="">
                                        @error('jumlah_hari')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating date">
                                        <label for="start_date" class="form-label">Check In</label>
                                        <input type="date"
                                            class="form-control mb-1 @error('start_date') is-invalid @enderror"
                                            id="start_date" name="start_date" value="{{ old('start_date') }}"
                                            placeholder="">
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating date">
                                        <label for="end_date" class="form-label">Check Out</label>
                                        <input type="date" class="form-control mb-1" id="end_date" name="end_date"
                                            value="{{ old('end_date') }}" placeholder="">
                                    </div>
                                </div>

                                <div class="col-6">
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

                                <div class="col-6">
                                    <div class="form-floating">
                                        <label for="kamarReady" class="form-label">Jumlah Kamar Tersedia</label>
                                        <input type="number" class="form-control mb-1" id="kamarReady"
                                            name="kamarReady" value="" placeholder="" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <label for="jumlah_kamar" class="form-label">Jumlah Kamar Yang Dipesan</label>
                                        <input type="number"
                                            class="form-control mb-1 @error('jumlah_kamar') is-invalid @enderror"
                                            id="jumlah_kamar" name="jumlah_kamar" value="{{ old('jumlah_kamar') }}"
                                            placeholder="">
                                        @error('jumlah_kamar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- SELECT PILIH KAMAR --}}
                                <div class="col-4" hidden>
                                    <label for="no_kamar" class="form-label">Pilih Kamar</label>
                                    <div class="kamarContainer">
                                        <select class="form-select mb-1" aria-label="Default select example"
                                            name="no_kamar[]" id="no_kamar" multiple size="">
                                            {{-- <option disabled selected>Pilih No Kamar</option> --}}
                                            @foreach ($kamar as $item)
                                                <option selected value="{{ $item->no_kamar }}"
                                                    data-kategori="{{ $item->id_kategori }}"
                                                    data-kamar="{{ $item->no_kamar }}">
                                                    {{ $item->no_kamar }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- SELECT PILIH KAMAR END --}}

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
                                        <label for="harga" class="form-label">Total Harga ( Membayar DP 25% )</label>
                                        <input type="number" class="form-control mb-1" id="harga" name="harga"
                                            value="" placeholder="" readonly>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value=""
                                            id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">I agree and accept the
                                            <a href="#" data-toggle="modal" data-target="#syaratModal">terms and
                                                conditions</a></label>
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

    <!-- Modal -->
    <div class="modal fade" id="syaratModal" tabindex="-1" aria-labelledby="syaratModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="mt-0">Syarat dan Ketentuan Pemesanan Hotel Bintang Flores</h4>
                    <hr>
                    <ol>
                        <li>
                            <strong>Pemesanan:</strong>
                            <ul>
                                <li>Pemesanan kamar harus didasarkan pada ketersediaan kamar pada tanggal yang
                                    diinginkan.</li>
                                <li>Pemesanan dapat dilakukan melalui telepon, email, atau melalui sistem pemesanan
                                    online yang tersedia.</li>
                                <li>Pemesanan harus mencantumkan informasi lengkap tentang tamu, termasuk nama lengkap,
                                    alamat, nomor telepon, dan email.</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Pembayaran:</strong>
                            <ul>
                                <li>Setelah pemesanan dikonfirmasi, tamu diharapkan untuk membayar deposit sebesar 25% dari
                                    total biaya pemesanan.</li>
                                <li>Pembayaran deposit dapat dilakukan melalui transfer bank atau metode pembayaran yang
                                    tersedia.</li>
                                <li>Pelunasan sisa pembayaran harus dilakukan sebelum tanggal check-in.</li>
                                <li>Jika pembayaran pelunasan tidak diterima sebelum tanggal check-in, reservasi dapat
                                    dibatalkan dan deposit tidak akan dikembalikan.</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Pembatalan:</strong>
                            <ul>
                                <li>Jika tamu memutuskan untuk membatalkan pemesanan, tidak ada pengembalian uang yang akan
                                    dilakukan.</li>
                                <li>Jika tamu tidak hadir pada tanggal check-in yang ditentukan tanpa memberikan
                                    pemberitahuan sebelumnya, deposit tidak akan dikembalikan dan pemesanan akan dianggap
                                    batal.</li>
                                <li>Jika tamu ingin memodifikasi tanggal pemesanan, hal tersebut akan tergantung pada
                                    ketersediaan kamar dan kebijakan hotel.</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Check-in dan Check-out:</strong>
                            <ul>
                                <li>Waktu check-in dimulai pada pukul 14:00 waktu setempat.</li>
                                <li>Tamu diharapkan untuk melaporkan kedatangannya jika melebihi waktu check-in yang
                                    ditentukan.</li>
                                <li>Waktu check-out adalah pukul 12:00 waktu setempat. Jika tamu ingin memperpanjang masa
                                    menginap, hal tersebut dapat ditanyakan kepada staf hotel.</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Tanggung Jawab dan Keamanan:</strong>
                            <ul>
                                <li>Hotel tidak bertanggung jawab atas kerugian atau kerusakan yang disebabkan oleh tamu
                                    selama
                                    masa menginap.</li>
                                <li>Tamu bertanggung jawab menjaga keamanan dan kebersihan kamar hotel serta perabotan yang
                                    ada
                                    di dalamnya.</li>
                                <li>Tamu diharapkan untuk mengikuti peraturan dan kebijakan yang berlaku di hotel.</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Pembatasan Usia:</strong>
                            <ul>
                                <li>Tamu yang ingin melakukan pemesanan dan check-in harus berusia minimal 18 tahun.</li>
                                <li>Jika tamu berusia di bawah 18 tahun, harus didampingi oleh orang dewasa yang bertanggung
                                    jawab.</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Perubahan atau Pembatalan oleh Hotel:</strong>
                            <ul>
                                <li>Hotel berhak untuk melakukan perubahan atau pembatalan pemesanan dalam keadaan tertentu,
                                    seperti bencana alam, perbaikan mendesak, atau keadaan yang di luar kendali hotel.</li>
                                <li>Jika hal tersebut terjadi, hotel akan berusaha memberikan alternatif yang setara atau
                                    mengembalikan jumlah pembayaran yang sudah dilakukan oleh tamu.</li>
                            </ul>
                        </li>
                        <li>
                            <strong>Privasi dan Keamanan Data:</strong>
                            <ul>
                                <li>Hotel akan menjaga privasi dan keamanan data pribadi tamu sesuai dengan kebijakan
                                    privasi yang berlaku.</li>
                            </ul>
                        </li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Understand</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END MODAL --}}
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
