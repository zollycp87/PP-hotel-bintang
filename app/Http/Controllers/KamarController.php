<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\KategoriKamar;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Kamar::with('kategori')->orderby('no_kamar', 'asc')->get();
        return view('admin.kelola-kamar', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $kode = Kamar::id();
        $kategori = KategoriKamar::all();
        return view('admin.kamar-form', compact('kategori','kode'));
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
        return view('admin.kamar-form',compact('data','kategori'));
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

        Kamar::where('no_kamar',$id)->update($data);
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
}
