<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kamar;
use NumberFormatter;
use App\Models\KategoriKamar;
use Carbon\Carbon;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class KategoriKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = KategoriKamar::orderBy('id_kategori', 'asc')->get();
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

        return view('admin.kelola-kategori', compact('posts', 'statusKamar', 'jumlahKamarReady'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kode = KategoriKamar::id();
        return view('admin.kategori-form', ['kode' => $kode]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nama_kategori', $request->nama_kategori);
        Session::flash('harga_kategori', $request->harga_kategori);
        Session::flash('kapasitas', $request->kapasitas);
        Session::flash('deskripsi', $request->deskripsi);

        $id_kategori = $request->input('id_kategori');

        $image = $request->file('img');
        if ($image) {
            // Jika ada file gambar yang diunggah, dapatkan ekstensinya
            $image_ekstensi = $image->extension();
            $image_name = date('ymhis') . "." . $image_ekstensi;
            $image->move(public_path('foto'), $image_name);
        } else {
            // Jika tidak ada file yang diunggah, berikan nilai default atau lakukan sesuai kebutuhan
            $image_name = '-';
        }

        $data = [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $request->nama_kategori,
            'harga_kategori' => $request->harga_kategori,
            'kapasitas' => $request->kapasitas,
            'deskripsi' => $request->deskripsi,
            'img' => $image_name
        ];
        KategoriKamar::create($data);
        $jumlahKamarReady = [];
        return redirect('admin/kelola-kategori')->with('success', 'Berhasil Menambahkan Data');
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
    public function edit($id_kategori)
    {
        $data = KategoriKamar::where('id_kategori', $id_kategori)->first();
        return view('admin.kategori-form', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $request->nama_kategori,
            'harga_kategori' => $request->harga_kategori,
            'kapasitas' => $request->kapasitas,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $image_ekstensi = $image->extension();
            $image_name = date('ymhis') . "." . $image_ekstensi;
            $image->move(public_path('foto'), $image_name);

            $data_foto = KategoriKamar::where('id_kategori', $id_kategori)->first();
            File::delete(public_path('foto') . '/' . $data_foto->img);

            $data['img'] = $image_name;
        }
        KategoriKamar::where('id_kategori', $id_kategori)->update($data);
        return redirect('admin/kelola-kategori')->with('success', 'Berhasil Mengubah Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_kategori)
    {
        $data = KategoriKamar::where('id_kategori', $id_kategori)->first();
        $data->delete();
        File::delete(public_path('foto') . '/' . $data->img);
        return redirect('admin/kelola-kategori')->with('success', 'Berhasil Menghapus Data');
    }
}
