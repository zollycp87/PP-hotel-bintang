<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KategoriKamar extends Model
{
    use HasFactory;

    protected $table = 'kategori_kamar';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;

    protected $keyType = 'string';
    protected $fillable = [
        'id_kategori',
        'nama_kategori',
        'harga_kategori',
        'kapasitas',
        'deskripsi',
        'img',
    ];

    public function kamar()
    {
        return $this->hasMany(Kamar::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailBooking::class);
    }

    public static function id()
    {
        $kode = DB::table('kategori_kamar')->max('id_kategori');
        $addNol = '';
        $kode = str_replace("P", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1) {
            $addNol = "0";
        }

        $kodeBaru = "P" . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
