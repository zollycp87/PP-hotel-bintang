<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'no_kamar';
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_kamar',
        'id_kategori',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriKamar::class, 'id_kategori');
    }

    public static function id()
    {
        $kode = DB::table('kamar')->max('no_kamar');
        $addNol = '';
        $kode = str_replace("K", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1) {
            $addNol = "0";
        }

        $kodeBaru = "K" . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
