<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karung extends Model
{
    use HasFactory;
    protected $table = 'karung';
    protected $fillable = [
        'no_karung', 'rak', 'batch', 'tahun', 'no_dok',
    ];
}