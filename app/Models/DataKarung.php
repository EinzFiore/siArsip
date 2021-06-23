<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKarung extends Model
{
    use HasFactory;
    protected $table = 'data_karung';
    protected $fillable = [
        'no_karung', 'rak', 'box', 'tahun',
    ];
}