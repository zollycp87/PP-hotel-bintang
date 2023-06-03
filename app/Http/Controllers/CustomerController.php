<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() //menampilkan data untuk ADMIN
    {
        $posts = Customer::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'Tamu');
            })
            ->orderBy('id_user', 'desc')
            ->get();
        return view('admin.kelola-customer', compact('posts'));
    }

    public function editProfile($id)
    {
        $data = Customer::with('user')->where('id_user', $id)->first();
        return view('cust.profilx', compact('data'));
    }

    
}
