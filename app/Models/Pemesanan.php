<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans';

    protected $fillable = [
        'jamaah_id',
        'keberangkatan_id',
        'tanggal_pesan',
        'total_tagihan',
        'status_pembayaran',
    ];

    public function jamaah()
    {
        return $this->belongsTo(Jamaah::class, 'jamaah_id');
    }

    public function jadwalKeberangkatan()
    {
        return $this->belongsTo(JadwalKeberangkatan::class, 'keberangkatan_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }


}
