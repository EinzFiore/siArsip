<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $table = "batch";
    protected $primaryKey = "batch";
    // public $timestamps = false;
    protected $fillable = [
        'batches','tahun_batch',
    ];
}
