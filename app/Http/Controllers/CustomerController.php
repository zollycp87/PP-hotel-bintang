<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\DetailBayar;
use App\Models\DetailBooking;
use App\Models\KategoriKamar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index() //menampilkan data untuk ADMIN
    {
        $today = Carbon::now()->format('Y-m-d');
        $posts = Customer::whereHas('booking', function ($query) use ($today) {
            $query->where(function ($query) use ($today) {
                $query->where('status_booking', 'Check In')
                    ->whereDate('start_date', '<=', $today);
            })->orWhere(function ($query) use ($today) {
                $query->where('status_booking', 'Check Out')
                    ->whereDate('end_date', '>=', $today);
            });
        })->get();
        return view('admin.kelola-customer', compact('posts'));
    }

    public function indexCust()
    {
        $kategoris = KategoriKamar::limit(3)->get();
        return view('cust.landing-page', compact('kategoris'));
    }

    public function riwayat() //Halaman riwayat
    {
        $posts = Booking::with('detail', 'customer', 'detailBayar')
            ->where('id_customer', Auth::user()->id_user)
            ->latest('invoice')
            ->get();

        $details = DetailBooking::with('kategori')
            ->select('invoice', 'id_kategori')
            ->selectRaw('COUNT(DISTINCT no_kamar) AS jumlah_kamar')
            ->groupBy('invoice', 'id_kategori')
            ->get();

        if ($posts->count() === 0) {
            $jumlahKamarReady = [];
            return view('cust.riwayat', compact('posts', 'details'));
        }

        return view('cust.riwayat', compact('posts', 'details'));
    }

    public function invoice($id) //Halaman riwayat
    {
        $details = DetailBooking::with('kategori')
            ->where('invoice', $id)
            ->select('invoice', 'id_kategori')
            ->selectRaw('COUNT(DISTINCT no_kamar) AS jumlah_kamar')
            ->groupBy('invoice', 'id_kategori')
            ->get();

        $bayarDP = DetailBayar::where('invoice', $id)
            ->where('status_bayar', 'DP')
            ->get();

        $bayarLunas = DetailBayar::where('invoice', $id)
            ->where('status_bayar', 'Pelunasan')
            ->get();

        // dd($data);
        $data = Booking::with('detail', 'customer', 'detailBayar')->where('invoice', $id)->first();
        return view('cust.invoice', compact('data', 'details', 'bayarLunas', 'bayarDP'));
    }

    public function kategoriList()
    {
        $kategoris = KategoriKamar::get();
        return view('cust.kategori-list', compact('kategoris'));
    }

    public function editProfile($id)
    {
        $data = Customer::with('user')->where('id_user', $id)->first();
        return view('cust.profilx', compact('data'));
    }

    public function filterCustomer(Request $request)
    {
        $bookingDate = $request->input('booking-date');
        $posts = Customer::whereHas('booking', function ($query) use ($bookingDate) {
            $query->where(function ($query) use ($bookingDate) {
                $query->where('status_booking', 'Check In')
                    ->whereDate('start_date', '<=', $bookingDate);
            })->orWhere(function ($query) use ($bookingDate) {
                $query->where('status_booking', 'Check Out')
                    ->whereDate('end_date', '>=', $bookingDate);
            });
        })->get();
        return view('admin.kelola-customer', compact('posts', 'bookingDate'));
    }
}
