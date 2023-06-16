<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\DetailBayar;
use App\Models\DetailBooking;
use App\Models\Kamar;
use App\Models\KategoriKamar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index() //Halaman Admin
    {
        $today = Carbon::now()->toDateString();
        $posts = Booking::with('detail', 'customer', 'detailBayar')
            ->where(function ($query) use ($today) {
                $query->where(function ($query) use ($today) {
                    $query->whereDate('tanggal_pesan', $today);
                })->orWhere(function ($query) use ($today) {
                    $query->whereDate('start_date', '<=', $today)
                        ->whereDate('end_date', '>=', $today);
                });
            })
            ->where(function ($query) {
                $query->where('id_user', Auth::user()->id_user)
                    ->orWhere('id_user', 'like', '%C%');
            })
            ->whereHas('detailBayar', function ($query) {
                $query->where(function ($query) {
                    $query->where('status_bayar', '!=', 'DP')
                        ->orWhereNot(function ($query) {
                            $query->whereNull('bukti_bayar')
                                ->orWhere('bukti_bayar', '-');
                        });
                });
            })
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        $details = DetailBooking::with('kategori')
            ->select('invoice', 'id_kategori')
            ->selectRaw('COUNT(DISTINCT no_kamar) AS jumlah_kamar')
            ->groupBy('invoice', 'id_kategori')
            ->get();
        // dd($posts);

        // $invoice = '';
        // $detailBayars = DetailBayar::where('invoice',$invoice)->get();

        if ($posts->count() === 0) {
            $jumlahKamarReady = [];
            return view('admin.kelola-booking', compact('posts', 'details'));
        }


        return view('admin.kelola-booking', compact('posts', 'details'));
    }

    public function bookingCust() //Halaman Customer
    {
        $invoice = Booking::invoice();
        $id_customer = User::id('booking.create');
        $kamar = Kamar::all();
        $kategori = KategoriKamar::all();
        return view('cust.booking', compact('invoice', 'id_customer', 'kamar', 'kategori'));
    }

    public function create()
    {
        $invoice = Booking::invoice();
        $id_customer = User::id('booking.create');
        $kamar = Kamar::all();
        $kategori = KategoriKamar::all();
        return view('admin.booking-form', compact('invoice', 'id_customer', 'kamar', 'kategori'));
    }

    public function edit($id)
    {
        $kamar = Kamar::all();
        $kategori = KategoriKamar::all();
        $details = DetailBooking::where('invoice', $id)->get();
        $detailBayars = DetailBayar::where('invoice', $id)->get();
        $data = Booking::with('detail', 'customer', 'detailBayar')->where('invoice', $id)->first();
        return view('admin.booking-form', compact('data', 'kategori', 'kamar', 'details', 'detailBayars'));
    }

    public function update(Request $request, $id)
    {
        $statusBayar = $request->input('status_pelunasan');
        $totalPelunasan = $request->input('pelunasan');
        $tanggalPelunasan = Carbon::today()->format('Y-m-d');

        if ($statusBayar === 'Pelunasan' && $totalPelunasan !== null) {
            $detail_bayar = [
                'invoice' => $id,
                'tanggal_bayar' => $tanggalPelunasan,
                'total_bayar' => $totalPelunasan,
                'status_bayar' => $statusBayar,
            ];

            $data = [
                'status_booking' => $request->input('status_booking'),
            ];

            DetailBayar::create($detail_bayar);
            Booking::where('invoice', $id)->update($data);
        } else {
            $data = [
                'status_booking' => $request->input('status_booking'),
            ];
            Booking::where('invoice', $id)->update($data);
        }

        return redirect('admin/booking')->with('success', 'Berhasil Mengubah Data');
    }


    public function getHarga($idKategori)
    {
        $harga = KategoriKamar::where('id_kategori', $idKategori)->pluck('harga_kategori')->first();

        return response()->json(['harga' => $harga]);
    }

    public function getHargaCust($idKategori)
    {
        $hargaMasuk = KategoriKamar::where('id_kategori', $idKategori)->pluck('harga_kategori')->first();

        $harga = $hargaMasuk / 4;

        return response()->json(['harga' => $harga]);
    }

    public function store(Request $request) //Menambah Booking
    {
        if (Auth::user()->role === "Admin" || Auth::user()->role === "Super Admin") {
            $request->validate([
                'nama' => 'required',
                'jumlah_kamar' => ['required', function ($attribute, $value, $fail) use ($request) {
                    $jumlahKamarInput = (int) $value;
                    $jumlahKamarArray = count($request->no_kamar);
                    if ($jumlahKamarInput !== $jumlahKamarArray) {
                        $fail('Jumlah kamar tidak sesuai');
                    }
                }],
                'jumlah_hari' => 'required|min:1',
                'start_date' => 'required|date|after_or_equal:' . Carbon::today()->format('Y-m-d'),
                'status_bayar' => 'required|in:1,2'
            ], [
                'nama.required' => 'Nama wajib diisi',
                'jumlah_kamar.required' => 'Jumlah kamar wajib diisi',
                'jumlah_hari.required' => 'Lama hari wajib diisi',
                'start_date.required' => 'Tanggal mulai wajib diisi',
                'jumlah_kamar.check_kamar_count' => 'Jumlah kamar tidak sesuai',
                'jumlah_hari.min' => 'Lama hari tidak valid',
                'start_date.date' => 'Tanggal mulai tidak valid',
                'start_date.after_or_equal' => 'Tanggal mulai tidak valid',
                'status_bayar.required' => 'Status bayar wajib diisi',
                'status_bayar.in' => 'Status bayar tidak valid',
            ]);

            Validator::extend('check_kamar_count', function ($attribute, $value, $parameters, $validator) {
                $no_kamar = $validator->getData()['no_kamar'];
                $jumlah_kamar = count($no_kamar);
                return $value == $jumlah_kamar;
            });

            $tanggal_pesan = Carbon::today()->format('Y-m-d');

            $customer = [
                'id_customer' => $request->input('id_customer'),
                'id_user' => "-",
                'nama' => $request->input('nama'),
                'status_cust' => $request->input('status')
            ];

            $booking = [
                'invoice' => $request->input('invoice'),
                'tanggal_pesan' => $tanggal_pesan,
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'id_user' => $request->input('id_user'),
                'id_customer' => $request->input('id_customer'),
                'status_booking' => $request->input('status_booking'),
            ];

            $detail_bayar = [
                'invoice' => $request->input('invoice'),
                'tanggal_bayar' => $tanggal_pesan,
                'total_bayar' => $request->input('harga'),
                'status_bayar' => $request->input('status_bayar'),
                'bukti_bayar' => '-'
            ];

            Customer::create($customer);
            Booking::create($booking);
            DetailBayar::create($detail_bayar);

            $invoice = $request->input('invoice');
            $idKategori = $request->input('id_kategori');
            $noKamarArray = $request->input('no_kamar');

            foreach ($noKamarArray as $noKamar) {
                $detailBooking = new DetailBooking();
                $detailBooking->invoice = $invoice;
                $detailBooking->id_kategori = $idKategori;
                $detailBooking->no_kamar = $noKamar;
                $detailBooking->save();
            }
            // dd($detail_booking);
            return redirect('admin/booking')->with('success', 'Berhasil Menambahkan Pesanan');
        } else if (Auth::user()->role === "Tamu") {
            $request->validate([
                'nama' => 'required',
                'jumlah_kamar' => ['required', function ($attribute, $value, $fail) use ($request) {
                    $jumlahKamarInput = (int) $value;
                    $kamarReady = (int) $request->input('kamarReady');
                    if ($jumlahKamarInput > $kamarReady) {
                        $fail('Jumlah kamar melebihi jumlah kamar yang tersedia');
                    }
                }],
                'jumlah_kamar' => 'required|min:1',
                'jumlah_hari' => 'required|min:1',
                'start_date' => 'required|date|after_or_equal:' . Carbon::today()->format('Y-m-d'),
            ], [
                'nama.required' => 'Nama wajib diisi',
                'jumlah_kamar.required' => 'Jumlah kamar wajib diisi',
                'jumlah_hari.required' => 'Lama hari wajib diisi',
                'start_date.required' => 'Tanggal mulai wajib diisi',
                // 'jumlah_kamar.check_kamar_count' => 'Jumlah kamar tidak sesuai',
                'jumlah_kamar.min' => 'Jumlah kamar tidak valid',
                'jumlah_hari.min' => 'Lama hari tidak valid',
                'start_date.date' => 'Tanggal mulai tidak valid',
                'start_date.after_or_equal' => 'Tanggal mulai tidak valid',
            ]);

            $tanggal_pesan = Carbon::today()->format('Y-m-d');
            $invoice = $request->input('invoice');
            $idKategori = $request->input('id_kategori');
            $noKamarArray = $request->input('no_kamar');

            $booking = [
                'invoice' => $invoice,
                'tanggal_pesan' => $tanggal_pesan,
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'id_user' => $request->input('id_customer'),
                'id_customer' => $request->input('id_customer'),
                'status_booking' => $request->input('status_booking'),
            ];

            $detail_bayar = [
                'invoice' => $request->input('invoice'),
                'tanggal_bayar' => $tanggal_pesan,
                'total_bayar' => $request->input('harga'),
                'status_bayar' => $request->input('status_bayar'),
                'bukti_bayar' => '-'
            ];
            // dd($booking);

            Booking::create($booking);
            DetailBayar::create($detail_bayar);

            foreach ($noKamarArray as $noKamar) {
                $detailBooking = new DetailBooking();
                $detailBooking->invoice = $invoice;
                $detailBooking->id_kategori = $idKategori;
                $detailBooking->no_kamar = $noKamar;
                $detailBooking->save();
            }

            // Mengambil semua data booking berdasarkan invoice
            $data = Booking::where('invoice', $invoice)->first();
            $details = DetailBooking::with('kategori')
                ->select('invoice', 'id_kategori')
                ->selectRaw('COUNT(DISTINCT no_kamar) AS jumlah_kamar')
                ->groupBy('invoice', 'id_kategori')
                ->get();

            return redirect()->route('cust.invoice', $invoice)->with([
                'bookings' => $data,
                'details' => $details,
                'success' => 'Berhasil Menambahkan Pesanan'
            ]);
        }
    }

    public function filterBooking(Request $request)
    {
        $bookingDate = $request->input('booking-date');

        $posts = Booking::with('detail', 'customer', 'detailBayar')
            ->where(function ($query) use ($bookingDate) {
                $query->where(function ($query) use ($bookingDate) {
                    $query->whereDate('tanggal_pesan', $bookingDate);
                })->orWhere(function ($query) use ($bookingDate) {
                    $query->whereDate('start_date', '<=', $bookingDate)
                        ->whereDate('end_date', '>=', $bookingDate);
                });
            })
            ->where(function ($query) {
                $query->where('id_user', Auth::user()->id_user)
                    ->orWhere('id_user', 'like', '%C%');
            })
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        $details = DetailBooking::with('kategori')
            ->select('invoice', 'id_kategori')
            ->selectRaw('COUNT(DISTINCT no_kamar) AS jumlah_kamar')
            ->groupBy('invoice', 'id_kategori')
            ->get();
        // dd($posts);
        return view('admin.kelola-booking', compact('posts', 'details', 'bookingDate'));
    }

    public function getAvailableRooms(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $id_kategori = $request->input('id_kategori');

        $bookings = Booking::whereBetween('start_date', [$start_date, $end_date])
            ->orWhereBetween('end_date', [$start_date, $end_date])
            ->orWhere(function ($query) use ($start_date, $end_date) {
                $query->where('start_date', '<', $start_date)
                    ->where('end_date', '>', $end_date);
            })
            ->get();

        $statusKamar = [];

        foreach ($bookings as $booking) {
            $detailBookings = DetailBooking::where('invoice', $booking->invoice)->get();
            foreach ($detailBookings as $detailBooking) {
                if ($booking->status_booking == 'Check In' || $booking->status_booking == 'Booking') {
                    $statusKamar[$detailBooking->no_kamar] = 'Booked';
                } else {
                    $statusKamar[$detailBooking->no_kamar] = 'Ready';
                }
            }
        }

        // Mengambil semua kamar yang tersedia berdasarkan id_kategori
        $kamarReady = Kamar::where('id_kategori', $id_kategori)
            ->whereNotIn('no_kamar', array_keys($statusKamar))
            ->get();

        // Membuat array untuk menyimpan data kamar yang tersedia
        $kamarTersedia = [];

        foreach ($kamarReady as $kamar) {
            $kamarTersedia[$kamar->no_kamar] = $kamar->nama_kamar;
        }

        return response()->json([
            'jumlah_kamar_ready' => count($kamarReady),
            'kamar_tersedia' => $kamarTersedia
        ]);
    }

    public function uploadBuktiBayar(Request $request, $id)
    {
        // dd('HAI');
        $request->validate([
            'img' => 'mimes:jpeg,png,jpg|max:2048'
        ], [
            'img.mimes' => 'Hanya format jpeg,png,jpg',
            'img.max' => 'Maksimum size 2 MB',
        ]);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $image_ekstensi = $image->extension();
            $image_name = date('ymhis') . "." . $image_ekstensi;
            $image->move(public_path('foto'), $image_name);

            $data_foto = DetailBayar::where('invoice', $id)
                ->where('status_bayar', 'DP')
                ->first();
            File::delete(public_path('foto') . '/' . $data_foto->bukti_bayar);

            $data['bukti_bayar'] = $image_name;
        }

        DetailBayar::where('invoice', $id)
            ->where('status_bayar', 'DP')
            ->update($data);
        return redirect()->back()->with('success-profile', 'Berhasil Mengubah Data');
    }
}
