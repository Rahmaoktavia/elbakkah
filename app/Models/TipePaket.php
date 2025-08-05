<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePaket extends Model
{
    use HasFactory;

    protected $table = 'tipe_pakets';

    protected $fillable = [
        'nama_tipe',
    ];

    public function paketUmrahs()
    {
        return $this->hasMany(PaketUmrah::class, 'tipe_paket_id');
    }
}
