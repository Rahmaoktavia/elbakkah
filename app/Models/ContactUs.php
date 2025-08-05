<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_uss';

    protected $fillable = [
        'nama',
        'email',
        'pertanyaan',
        'jawaban',
        'is_published',
    ];
}
