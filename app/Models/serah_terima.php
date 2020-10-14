<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serah_terima extends Model
{
    protected $table = 'serah_terima';
    protected $fillable = [
        'no_surat','tanggal'
    ];
    use HasFactory;
}
