<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\JadwalKeberangkatan;
use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class PaketUmrah extends Model
{
    use HasFactory;

    protected $table = 'paket_umrahs';

    protected $fillable = [
    'nama_paket',
    'gambar_paket',
    'harga',
    'jumlah_hari',
    'hotel_makkah',
    'hotel_madinah',
    'fasilitas',
    'deskripsi',
    'tipe_paket_id',
    ];

       public function jadwalKeberangkatan()
    {
        return $this->hasMany(JadwalKeberangkatan::class, 'paket_id');
    }

    public function pemesanan(): HasManyThrough
    {
        return $this->hasManyThrough(
            Pemesanan::class,
            JadwalKeberangkatan::class,
            'paket_id',          // Foreign key di tabel JadwalKeberangkatan yang menunjuk ke PaketUmrah
            'keberangkatan_id',  // Foreign key di tabel Pemesanan yang menunjuk ke JadwalKeberangkatan
            'id',                // Local key di tabel PaketUmrah
            'id'                 // Local key di tabel JadwalKeberangkatan
        );
    }

    public function tipePaket()
    {
        return $this->belongsTo(TipePaket::class, 'tipe_paket_id');
    }
}
