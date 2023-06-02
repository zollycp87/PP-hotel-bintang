<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KategoriKamarController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('test');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    // Kelola User
    Route::get('/kelola-user', function () {
        return view('admin.kelola-user');
    })->name('kelola-user');
    Route::resource('/kelola-user', UserController::class);
    Route::put('/password/{kelola_user}', [UserController::class, 'ubahPassword'])->name('ubah-password')->middleware('auth');
    Route::put('/profile/{kelola_user}', [UserController::class, 'ubahProfile'])->name('ubah-profile')->middleware('auth');
    // END

    // Kelola Kategori
    Route::get('/kelola-kategori', function () {
        return view('admin.kelola-kategori');
    });
    Route::get('/kategori-form', function () {
        return view('admin.kategori-form');
    });
    Route::resource('/kelola-kategori', KategoriKamarController::class);
    // END

    //Kelola Kamar
    Route::get('/kelola-kamar', function () {
        return view('admin.kelola-kamar');
    });
    Route::get('/kamar-form', function () {
        return view('admin.kamar-form');
    });
    Route::resource('/kelola-kamar', KamarController::class);
    // END
});

Route::prefix('cust')->group(function () {
    Route::get('/landing-page', function () {
        return view('cust.landing-page');
    });
});

//Login
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');

//Register
Route::get('/register', [AuthController::class, 'loadRegister'])->name('register')->middleware('guest');
Route::post('/register/store', [AuthController::class, 'store'])->name('register.store')->middleware('guest');

//Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');