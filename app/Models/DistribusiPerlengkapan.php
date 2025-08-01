<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DistribusiPerlengkapan extends Model
{
    use HasFactory;

    protected $table = 'distribusi_perlengkapans';

    protected $fillable = [
        'jamaah_id',
        'perlengkapan_id',
        'jumlah_diberikan',
        'tanggal_distribusi',
    ];

    public function jamaah()
    {
        return $this->belongsTo(Jamaah::class);
    }

    public function perlengkapan()
    {
        return $this->belongsTo(InventarisPerlengkapan::class);
    }
}
