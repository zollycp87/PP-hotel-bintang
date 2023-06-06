<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    // public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'username',
        'nama',
        'email',
        'password',
        'role',
        'img'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class. 'id_customer');
    }



    public static function id($route)
    {
        if ($route === 'register') {
            $prefix = 'C';
            $kode = DB::table('users')->where('id_user', 'LIKE', $prefix . '%')->max('id_user');
        } else if($route === 'booking.create'){
            $prefix = 'CU';
            $kode = DB::table('customer')->where('id_customer', 'LIKE', $prefix . '%')->max('id_customer');
        }
        else {
            $prefix = 'A';
            $kode = DB::table('users')->where('id_user', 'LIKE', $prefix . '%')->max('id_user');
        }

        $kode = str_replace($prefix, '', $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        // $addNol = ($incrementKode < 10) ? '0' : '';

        // $kodeBaru = $prefix . $addNol . $incrementKode;
        $kodeBaru = $prefix . $incrementKode;
        return $kodeBaru;
    }
}
