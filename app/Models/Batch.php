<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $table = "batch";
    // public $timestamps = false;
    protected $fillable = [
        'nomor','tahun_batch','batchDoc'
    ];
}
