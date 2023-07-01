<?php

namespace App\Http\Controllers;

use App\Charts\BookingChart;
use App\Models\Booking;
use App\Models\DetailBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->toDateString();

        //Data-booking per hari ini
        $bookings = Booking::with('detail', 'customer', 'detailBayar')
            ->where(function ($query) use ($today) {
                $query->whereDate('tanggal_pesan', $today);
            })
            ->where(function ($query) {
                $query->where('id_user', Auth::user()->id_user)
                    ->orWhere('id_user', 'like', '%C%');
            })
            ->where('status_booking', '!=', 'Cancel')
            ->where('status_booking', '!=', 'New')
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        $countBookings = count($bookings) ?? 0;

        $todayCount = Booking::whereDate('tanggal_pesan', today())->count();
        $yesterdayCount = Booking::whereDate('tanggal_pesan', today()->subDay())
            ->where('status_booking', '!=', 'Cancel')
            ->where('status_booking', '!=', 'New')
            ->count();

        $difference = $todayCount - $yesterdayCount;
        $percenBooking = 0; // Default value in case of division by zero

        if ($yesterdayCount != 0) {
            $percenBooking = ($difference / $yesterdayCount) * 100;
            $percenBooking = round($percenBooking, 2);
        }
        //Booking-END

        //Pendapatan
        $pendapatan = Booking::join('detail_bayar', 'booking.invoice', '=', 'detail_bayar.invoice')
            ->whereDate('detail_bayar.tanggal_bayar', today())
            ->whereNotIn('booking.status_booking', ['New', 'Cancel'])
            ->sum('detail_bayar.total_bayar');

        $pendapatanBefore = Booking::join('detail_bayar', 'booking.invoice', '=', 'detail_bayar.invoice')
            ->whereDate('detail_bayar.tanggal_bayar', today()->subDay())
            ->whereNotIn('booking.status_booking', ['New', 'Cancel'])
            ->sum('detail_bayar.total_bayar');

        $difference = $pendapatan - $pendapatanBefore;
        $percenPendapatan = 0; // Default value in case of division by zero

        if ($pendapatanBefore != 0) {
            $percenPendapatan = ($difference / $pendapatanBefore) * 100;
            $percenPendapatan = round($percenPendapatan, 2);
        }


        //Cust-Count
        $customerCount = Booking::join('customer', 'booking.id_customer', '=', 'customer.id_customer')
            // ->whereDate('booking.start_date', today())
            ->where('booking.status_booking', 'Check In')
            ->count();
        //END


        //Tabel Booking
        $posts = Booking::with('detail', 'customer', 'detailBayar')
            ->where(function ($query) use ($today) {
                $query->where(function ($query) use ($today) {
                    $query->whereDate('tanggal_pesan', $today);
                })->orWhere(function ($query) use ($today) {
                    $query->whereDate('start_date', '<=', $today)
                        ->whereDate('end_date', '>=', $today);
                });
            })
            ->where(function ($query) {
                $query->where('id_user', Auth::user()->id_user)
                    ->orWhere('id_user', 'like', '%C%');
            })
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('status_booking', '!=', 'New')
                        ->where('status_booking', '!=', 'Cancel');
                })
                    ->orWhere(function ($query) {
                        $query->whereHas('detailBayar', function ($query) {
                            $query->where('status_bayar', '!=', 'DP')
                                ->orWhere(function ($query) {
                                    $query->whereNotNull('bukti_bayar')
                                        ->where('bukti_bayar', '!=', '-');
                                });
                        });
                    });
            })
            ->orderBy('invoice', 'desc')
            ->get();

        $details = DetailBooking::with('kategori')
            ->select('invoice', 'id_kategori')
            ->selectRaw('COUNT(DISTINCT no_kamar) AS jumlah_kamar')
            ->groupBy('invoice', 'id_kategori')
            ->get();

        if ($posts->count() === 0 || $bookings->count() === 0 || $details->count() === 0) {
            $jumlahKamarReady = [];
            return view('admin.dashboard', compact('bookings', 'percenBooking', 'pendapatan', 'percenPendapatan', 'customerCount', 'posts', 'details'));
        }
        //Tabel-Booking END


        return view(
            'admin.dashboard',
            compact('bookings', 'percenBooking', 'pendapatan', 'percenPendapatan', 'customerCount', 'posts', 'details')
        );
    }
}
