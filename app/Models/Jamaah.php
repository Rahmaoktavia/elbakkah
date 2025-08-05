<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Jamaah extends Model
{
    use HasFactory;

    protected $table = 'jamaahs';

    protected $fillable = [
        'user_id',
        'nama_jamaah',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'nama_ayah',
        'pekerjaan',
        'jenis_kelamin',
        'pas_foto',
        'file_ktp',
        'file_kk',
        'file_paspor',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function getUmurAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
}
