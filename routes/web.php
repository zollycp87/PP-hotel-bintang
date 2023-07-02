<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HitungController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KategoriKamarController;
use App\Http\Controllers\UserController;
use App\Models\Kamar;
use App\Models\KategoriKamar;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('cust.landing-page');
// });
Route::get('/about-us', function () {
    return view('cust.about-us');
})->name('about-us');
Route::get('/contact-us', function () {
    return view('cust.contact-us');
})->name('contact-us');

Route::get('/', [CustomerController::class, 'indexCust'])->name('landing-page');
Route::get('/kategori-list', [CustomerController::class, 'kategoriList'])->name('kategori-list');
Route::get('/detail-kategori/{id}', [CustomerController::class, 'detailKategori'])->name('detail-kategori');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');

    // Kelola User
    Route::get('/kelola-user', function () {
        return view('admin.kelola-user');
    })->name('kelola-user');
    Route::resource('/kelola-user', UserController::class);
    Route::put('/password/{kelola_user}', [UserController::class, 'ubahPassword'])->name('ubah-password')->middleware('auth');
    Route::put('/profile/{kelola_user}', [UserController::class, 'ubahProfile'])->name('ubah-profile')->middleware('auth');
    // END

    //Kelola Customer
    Route::resource('/kelola-customer', CustomerController::class);
    Route::post('/customer/filter', [CustomerController::class, 'filterCustomer'])->name('customer.filter');

    //END

    // Kelola Kategori
    Route::get('/kelola-kategori', function () {
        return view('admin.kelola-kategori');
    })->name('kelola-kategori');
    Route::get('/kategori-form', function () {
        return view('admin.kategori-form');
    });
    Route::resource('/kelola-kategori', KategoriKamarController::class);
    // END

    //Kelola Kamar
    Route::resource('/kelola-kamar', KamarController::class);
    Route::post('/kelola-kamar/filter', [KamarController::class, 'filter'])->name('kelola-kamar.filter');
    // END

    //Kelola Booking
    Route::resource('/booking', BookingController::class);
    Route::get('/get-harga/{idKategori}', [BookingController::class, 'getHarga'])->name('get.harga');
    Route::post('/booking/filter', [BookingController::class, 'filterBooking'])->name('booking.filter');
    Route::post('/booking/filterkamar', [BookingController::class, 'kamarReadyFilter'])->name('kamarReady.filter');
    Route::post('/get-kamar-by-kategori', [BookingController::class, 'getKamarByKategori'])->name('get.kamar.by.kategori');

    //END
});

//ROLE-CUSTOMER
Route::prefix('cust')->group(function () {
    Route::get('/landing-page', function () {
        $kategoris = KategoriKamar::limit(3)->get();
        return view('cust.landing-page', compact('kategoris'));
    })->name('cust.landing-page');

    Route::put('/password/{kelola_user}', [UserController::class, 'ubahPasswordCust'])->name('ubah-password-cust')->middleware('auth');
    Route::get('/profile/{kelola_user}', [UserController::class, 'editProfileCust'])->name('edit-profile-cust')->middleware('auth');
    Route::put('/profile/{kelola_user}', [UserController::class, 'ubahProfileCust'])->name('ubah-profile-cust')->middleware('auth');
    
    // Route::resource('/booking', BookingController::class);
    Route::post('/booking', [BookingController::class, 'store'])->name('cust-create-booking');
    Route::post('/get-available-rooms', [BookingController::class, 'getAvailableRooms']);
    Route::get('/booking', [BookingController::class, 'bookingCust'])->name('cust-booking');
    Route::get('/get-harga/{idKategori}', [BookingController::class, 'getHargaCust'])->name('get.hargaCust');
    Route::get('/riwayat', [CustomerController::class, 'riwayat'])->name('cust.riwayat');
    Route::get('/invoice/{invoice}', [CustomerController::class, 'invoice'])->name('cust.invoice');
    Route::get('/cancel/{invoice}', [BookingController::class, 'cancelBooking'])->name('cust-cancel');
    Route::put('/invoice/{invoice}', [BookingController::class, 'uploadBuktiBayar'])->name('cust-bukti-upload');
});

//Login
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');

//Register
Route::get('/register', [AuthController::class, 'loadRegister'])->name('register')->middleware('guest');
Route::post('/register/store', [AuthController::class, 'store'])->name('register.store')->middleware('guest');

//Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

