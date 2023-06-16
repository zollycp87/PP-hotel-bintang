<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CancelPendingBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cancel-pending-bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Cancelled By System';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookings = DB::table('booking')
            ->select('booking.*', 'detail_bayar.*')
            ->join('detail_bayar', 'booking.invoice', '=', 'detail_bayar.invoice')
            ->where('booking.status_booking', 'New')
            ->where('detail_bayar.status_bayar', 'DP')
            ->where(function ($query) {
                $query->whereNull('detail_bayar.bukti_bayar')
                    ->orWhere('detail_bayar.bukti_bayar', '-');
            })
            ->get();

        $now = Carbon::now();
        foreach ($bookings as $booking) {
            $created_at = Carbon::parse($booking->created_at);
            $minutesOverdue = $now->diffInMinutes($created_at);

            if ($booking->status_booking == 'New' && $minutesOverdue >= 1) {
                DB::table('booking')
                    ->where('invoice', $booking->invoice)
                    ->update(['status_booking' => 'Cancel']);
            }
        }
    }
}
