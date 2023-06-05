<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HitungController extends Controller
{
    public function calculatePrice(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        $numberOfDays = $endDate->diffInDays($startDate);
        $pricePerDay = 60000;
        $totalPrice = $pricePerDay * $numberOfDays;

        return response()->json(['total_price' => $totalPrice]);
    }
}
