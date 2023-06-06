<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'id_customer';
    // public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_customer',
        'id_user',
        'nama',
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'status_cust'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

}
