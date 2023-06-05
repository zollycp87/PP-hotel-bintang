<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loadRegister()
    {
        $kode = User::id('register');
        return view('auth.register', compact('kode'));
    }

    public function login(Request $request) //Proses Login
    {
        $infologin = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        if (Auth::attempt($infologin)) {
            //kalau berhasil
            $request->session()->regenerate();
            if (Auth::user()->role == 'Admin') {

                return redirect()->intended('admin/dashboard');
            } else if (Auth::user()->role == 'Tamu') {

                return redirect()->intended('cust/landing-page');
            }
        } else {
            return back()->with('loginError', 'Login Gagal');
        }
    }

    public function store(Request $request) //Proses Register
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|regex:/^[A-Za-z0-9_]+$/',
            'password' => 'required|min:8',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Hanya boleh dalam format email',
            'email.unique' => 'Email sudah digunakan',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'username.regex' => 'Username Hanya diperbolehkan Angka, Huruf dan _',
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

        Customer::create([
            'id_customer' => $request->input('id_customer'),
            'id_user' => $request->input('id_user'),
            'nama' => $request->input('nama'),
            'status_cust' => $request->input('status')
            // Tambahkan data pelanggan lain yang diperlukan
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            //kalau berhasil
            $request->session()->regenerate('users');
            return redirect('cust/landing-page')->with('success', Auth::user()->nama . 'Berhasil Login');
        }

        return back()->with('loginError', 'Login Gagal');
    }

    public function logout(Request $request) //Proses Logout
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
