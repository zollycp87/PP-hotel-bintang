<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\KategoriKamar;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() //menampilkan data untuk ADMIN
    {
        $posts = Customer::all();
        return view('admin.kelola-customer', compact('posts'));
    }

    public function indexCust(){
        $kategoris = KategoriKamar::limit(3)->get();
        return view('cust.landing-page', compact('kategoris'));
    }

    public function editProfile($id)
    {
        $data = Customer::with('user')->where('id_user', $id)->first();
        return view('cust.profilx', compact('data'));
    }



    
}
