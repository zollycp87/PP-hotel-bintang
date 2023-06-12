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
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index() //Admin
    {
        $today = Carbon::now()->toDateString();
        $posts = Booking::with('detail', 'customer', 'detailBayar')
            ->whereDate('tanggal_pesan', $today)
            ->where('id_user', Auth::user()->id_user)
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

    public function bookingCust() //Customer
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

    public function store(Request $request)
    {
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
    }

    public function filterBooking(Request $request)
    {
        $bookingDate = $request->input('booking-date');

        $posts = Booking::with('detail', 'customer')
            ->whereDate('tanggal_pesan', $bookingDate)
            ->where('id_user', Auth::user()->id_user)
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

    // public function kamarReadyFilter(Request $request)
    // {
    //     $posts = Kamar::with('kategori')->orderby('no_kamar', 'asc')->get();
    //     $request->validate([
    //         'start_date' => 'required|date|after_or_equal:' . Carbon::today()->format('Y-m-d'),
    //     ], [
    //         'start_date.after_or_equal' => 'Tanggal mulai tidak valid'
    //     ]);

    //     $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');

    //     $bookings = Booking::where(function ($query) use ($start_date, $end_date) {
    //         $query->whereBetween('start_date', [$start_date, $end_date])
    //             ->orWhereBetween('end_date', [$start_date, $end_date])
    //             ->orWhere(function ($query) use ($start_date, $end_date) {
    //                 $query->where('start_date', '<', $start_date)
    //                     ->where('end_date', '>', $end_date);
    //             });
    //     })
    //         ->get();

    //     $statusKamar = [];
    //     $jumlahKamarReady = [];

    //     foreach ($bookings as $booking) {
    //         $detailBookings = DetailBooking::where('invoice', $booking->invoice)->get();
    //         foreach ($detailBookings as $detailBooking) {
    //             if ($booking->status == 'check out' || $booking->status == 'cancel') {
    //                 $statusKamar[$detailBooking->no_kamar] = 'Ready';
    //             } else {
    //                 $statusKamar[$detailBooking->no_kamar] = 'Booked';
    //             }
    //         }
    //     }

    //     // Mengambil kamar yang berstatus "ready"
    //     $kamarReady = Kamar::whereNotIn('no_kamar', array_keys($statusKamar))->get();

    //     return response()->json([
    //         'status' => 'success',
    //         'kamarReady' => $kamarReady
    //     ]);
    //     // return view('admin.booking-form', compact('invoice', 'id_customer', 'kamar', 'kategori', 'posts', 'statusKamar', 'jumlahKamarReady', 'kamarReady', 'start_date', 'end_date'));
    // }

    // public function getKamarByKategori(Request $request)
    // {
    //     $idKategori = $request->input('id_kategori');
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     // Retrieve booked room numbers within the specified date range
    //     $bookedRooms = Booking::where(function ($query) use ($startDate, $endDate) {
    //         $query->where('start_date', '<=', $endDate)
    //             ->where('end_date', '>=', $startDate);
    //     })
    //         ->where('status_booking', '!=', 'Check Out')
    //         ->where('status_booking', '!=', 'Cancel')
    //         ->pluck('no_kamar')
    //         ->toArray();

    //     // Retrieve available rooms based on the category and exclude the booked rooms
    //     $kamarKategori = Kamar::where('id_kategori', $idKategori)
    //         ->whereNotIn('no_kamar', $bookedRooms)
    //         ->get();

    //     return response()->json(['status' => 'success', 'kamarReady' => $kamarKategori]);
    // }

    public function printInvoice($invoice)
    {
    }
}
