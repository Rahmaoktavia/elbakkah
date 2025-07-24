<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PaketUmrah;

class JadwalKeberangkatan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_keberangkatans';

    protected $fillable = [
        'paket_id',
        'tanggal_berangkat',
        'kuota',
    ];

    public function paket()
    {
        return $this->belongsTo(PaketUmrah::class, 'paket_id');
    }
}
