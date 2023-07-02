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

    public function invoice($id) //Halaman invoice
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

    public function detailKategori($id)
    {
        $data = KategoriKamar::where('id_kategori', $id)->first();
        $kamars = Kamar::with('kategori')->orderby('no_kamar', 'asc')->get();
        $today = Carbon::now()->toDateString();
        $statusKamar = [];

        // Pengecekan jika database masih kosong
        if ($kamars->count() === 0) {
            return view('admin.kelola-kategori', compact('posts')); // Ganti dengan route yang sesuai
        }

        foreach ($kamars as $post) {
            $booking = Booking::where('start_date', '<=', $today)
                ->where('end_date', '>=', $today)
                ->whereIn('status_booking', ['Check In', 'Booking', 'New'])
                ->whereHas('detail', function ($query) use ($post) {
                    $query->where('no_kamar', $post->no_kamar);
                })
                ->first();

            if ($booking) {
                $statusKamar[$post->no_kamar] = 'Booked';
            } else {
                $statusKamar[$post->no_kamar] = 'Ready';
                if (!isset($jumlahKamarReady[$post->kategori->id_kategori])) {
                    $jumlahKamarReady[$post->kategori->id_kategori] = 1;
                    $kategoriKamar[] = $post->kategori->id_kategori;
                } else {
                    $jumlahKamarReady[$post->kategori->id_kategori]++;
                }
            }
        }

        // Cek kategori yang tidak memiliki kamar ready
        $kategoriTidakReady = KategoriKamar::whereNotIn('id_kategori', $kategoriKamar)->get();

        // Tambahkan kategori yang tidak memiliki kamar ready ke dalam array $jumlahKamarReady
        foreach ($kategoriTidakReady as $kategori) {
            $jumlahKamarReady[$kategori->id_kategori] = 0;
        }
        return view('cust.detail-kategori', compact('data','jumlahKamarReady'));
    }
}
