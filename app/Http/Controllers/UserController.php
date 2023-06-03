<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get posts
        $posts = User::all();
        //return $posts;
        //render view with posts
        return view('admin.kelola-user')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kode = User::id('kelola-user.create');
        return view('admin.user-form', compact('kode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Hanya boleh dalam format email',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimum 8 karakter',
        ]);

        $data = [
            'id_user' => $request->input('id_user'),
            'role' => $request->input('role'),
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ];

        User::create($data);
        return redirect('admin/kelola-user')->with('success', 'Berhasil Menambahkan Data Admin');
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
    public function edit(string $id)
    {
        $data = User::where('id_user', $id)->first();
        return view('admin.user-form',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    public function ubahPassword (Request $request, $id){

        $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|min:8',
            'confirm-password' => 'required|same:new-password',
        ],[
            'current-password.required' => 'Lengkapi inputan',
            'new-password.required' => 'Lengkapi inputan',
            'confirm-password.required' => 'Lengkapi inputan',
            'new-password.min' => 'Password minimum 8 karakter',
            'confirm-password.same' => 'Password tidak sama',
        ]);

        $user = User::where('id_user',Auth::user()->id_user)->first();
        
        // Memeriksa apakah password saat ini sesuai dengan yang diberikan
        if (!Hash::check($request->input('current-password'), $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak valid.']);
        }

        // Memperbarui password pengguna
        $user->password = Hash::make($request->input('new-password'));
        $user->update();

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }

    public function ubahProfile (Request $request, $id){
        dd('hai Profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
