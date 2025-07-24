<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\JadwalKeberangkatan;

class PaketUmrah extends Model
{
    use HasFactory;

    protected $table = 'paket_umrahs';

    protected $fillable = [
    'nama_paket',
    'gambar_paket',
    'harga',
    'jumlah_hari',
    'fasilitas',
    'deskripsi',
    ];

       public function jadwalKeberangkatan()
    {
        return $this->hasMany(JadwalKeberangkatan::class, 'paket_id');
    }

}
