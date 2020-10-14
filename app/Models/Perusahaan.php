<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = "Perusahaan";
    protected $fillable = [
        'no_pen','nama_perusahaan'
    ];
}
