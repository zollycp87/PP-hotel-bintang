<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\DetailBooking;
use App\Models\Kamar;
use App\Models\KategoriKamar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() //Admin
    {
        $posts = Booking::all();
        return view('admin.kelola-booking', compact('posts'));
    }

    public function create()
    {
        $invoice = Booking::invoice();
        $id_customer = User::id('booking.create');
        $kamar = Kamar::all();
        $kategori = KategoriKamar::all();
        return view('admin.booking-form', compact('invoice', 'id_customer', 'kamar', 'kategori'));
    }


    public function getHarga($idKategori)
    {
        $harga = KategoriKamar::where('id_kategori', $idKategori)->pluck('harga_kategori')->first();

        return response()->json(['harga' => $harga]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jumlah_kamar' => 'required',
            'jumlah_hari' => 'required|min:1',
            'start_date' => 'required|date|after_or_equal:' . Carbon::today()->format('Y-m-d'),
        ], [
            'nama.required' => 'Nama wajib diisi',
            'jumlah_kamar.required' => 'Jumlah kamar wajib diisi',
            'jumlah_hari.required' => 'Lama hari wajib diisi',
            'start_date.required' => 'Tanggal mulai wajib diisi',
            'jumlah_hari.min' => 'Lama hari tidak valid',
            'start_date.date' => 'Tanggal mulai tidak valid',
            'start_date.after_or_equal' => 'Tanggal mulai tidak valid'
        ]);

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
            'id_customer' => $request->input('id_customer'),
            'total_bayar' => $request->input('harga'),
            'status_booking' => $request->input('status_booking'),
        ];

        Customer::create($customer);
        Booking::create($booking);

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
}
