<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';
    protected $primaryKey = 'invoice';
    // public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'invoice',
        'tanggal_pesan',
        'start_date',
        'end_date',
        'id_user',
        'id_customer',
        'status_booking'
    ];

    public function detail()
    {
        return $this->hasMany(DetailBooking::class, 'invoice');
    }
    
    public function detailBayar()
    {
        return $this->hasMany(DetailBayar::class, 'invoice');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }
    
    public static function invoice()
    {
        $prefix = 'INV';

        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->format('YmdHis');

        $invoiceCode = $prefix . $formattedDateTime;

        return $invoiceCode;
    }
}
