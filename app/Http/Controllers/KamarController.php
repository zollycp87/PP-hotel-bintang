<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DetailBooking;
use App\Models\Kamar;
use App\Models\KategoriKamar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Kamar::with('kategori')->orderby('no_kamar', 'asc')->get();
        $today = Carbon::now()->toDateString();
        $statusKamar = [];

        if ($posts->count() === 0) {
            $jumlahKamarReady = [];
            return view('admin.kelola-kamar', compact('posts', 'statusKamar', 'jumlahKamarReady'));
        }

        foreach ($posts as $post) {
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

        return view('admin.kelola-kamar', compact('posts', 'statusKamar', 'jumlahKamarReady'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kode = Kamar::id();
        $kategori = KategoriKamar::all();
        return view('admin.kamar-form', compact('kategori', 'kode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('status', $request->status);

        $id_kategori = $request->input('id_kategori');
        $no_kamar = $request->input('no_kamar');

        $data = [
            'id_kategori' => $id_kategori,
            'no_kamar' => $no_kamar,
            'status' => $request->status,
        ];
        Kamar::create($data);
        return redirect('admin/kelola-kamar')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = KategoriKamar::all();
        $data = Kamar::with('kategori')->where('no_kamar', $id)->first();
        return view('admin.kamar-form', compact('data', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id_kategori = $request->input('id_kategori');
        $no_kamar = $request->input('no_kamar');

        $data = [
            'id_kategori' => $id_kategori,
            'no_kamar' => $no_kamar,
            'status' => $request->status,
        ];

        Kamar::where('no_kamar', $id)->update($data);
        return redirect('admin/kelola-kamar')->with('success', 'Berhasil Mengubah Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kamar::where('no_kamar', $id)->first();
        $data->delete();
        return redirect('admin/kelola-kamar')->with('success', 'Berhasil Menghapus Data');
    }

    public function filter(Request $request)
    {
        // dd("HAI");
        $posts = Kamar::with('kategori')->orderby('no_kamar', 'asc')->get();
        $request->validate([
            'start_date' => 'required|date|after_or_equal:' . Carbon::today()->format('Y-m-d'),
        ], [
            'start_date.after_or_equal' => 'Tanggal mulai tidak valid'
        ]);

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $bookings = Booking::where(function ($query) use ($start_date, $end_date) {
            $query->whereBetween('start_date', [$start_date, $end_date])
                ->orWhereBetween('end_date', [$start_date, $end_date])
                ->orWhere(function ($query) use ($start_date, $end_date) {
                    $query->where('start_date', '<', $start_date)
                        ->where('end_date', '>', $end_date);
                });
        })
            ->whereIn('status_booking', ['Check In', 'Booking', 'New'])
            ->get();

        $statusKamar = [];
        $jumlahKamarReady = [];

        foreach ($bookings as $booking) {
            $detailBookings = DetailBooking::where('invoice', $booking->invoice)->get();
            foreach ($detailBookings as $detailBooking) {
                if ($booking->status_booking == 'Check In' || $booking->status_booking == 'Booking' || $booking->status_booking == 'New') {
                    $statusKamar[$detailBooking->no_kamar] = 'Booked';
                } else {
                    $statusKamar[$detailBooking->no_kamar] = 'Ready';
                }
            }
        }

        // Mengambil kamar yang berstatus "ready"
        $kamarReady = Kamar::whereNotIn('no_kamar', array_keys($statusKamar))->get();

        // Menghitung jumlah kamar yang ready
        $jumlahKamarReady = Kamar::whereNotIn('no_kamar', array_keys($statusKamar))
            ->select('id_kategori', DB::raw('count(*) as jumlah_kamar_ready'))
            ->groupBy('id_kategori')
            ->get()
            ->pluck('jumlah_kamar_ready', 'id_kategori');

        // Mengambil semua kategori kamar
        $kategoriKamar = KategoriKamar::pluck('id_kategori')->toArray();
        // Menambahkan kategori yang tidak memiliki kamar ready
        foreach ($kategoriKamar as $kategori) {
            if (!isset($jumlahKamarReady[$kategori])) {
                $jumlahKamarReady[$kategori] = 0;
            }
        }

        // Mengirimkan data ke tampilan
        return view('admin.kelola-kamar', compact('posts', 'statusKamar', 'jumlahKamarReady'));
    }
}
