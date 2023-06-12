<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\KategoriKamar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() //menampilkan data untuk ADMIN
    {
        $today = Carbon::now()->format('Y-m-d');
        $posts = Customer::whereHas('booking', function ($query) use ($today) {
            $query->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today)
                ->where('status_booking', 'Check In');
        })->get();
        return view('admin.kelola-customer', compact('posts'));
    }

    public function indexCust()
    {
        $kategoris = KategoriKamar::limit(3)->get();
        return view('cust.landing-page', compact('kategoris'));
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
            $query->whereDate('start_date', '<=', $bookingDate)
                ->whereDate('end_date', '>=', $bookingDate)
                ->where('status_booking', 'Check In');
        })->get();
        return view('admin.kelola-customer', compact('posts', 'bookingDate'));
    }
}
