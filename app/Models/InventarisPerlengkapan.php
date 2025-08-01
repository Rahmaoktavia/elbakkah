<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventarisPerlengkapan extends Model
{
    use HasFactory;

    protected $table = 'inventaris_perlengkapans';

    protected $fillable = [
        'nama_perlengkapan',
        'jumlah_total',
        'jumlah_tersedia',
        'satuan',
        'tanggal_input',
    ];
}
