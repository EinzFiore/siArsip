<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tmpDataBatch extends Model
{
    use HasFactory;
    protected $table = 'tmp_data_batches';
    protected $fillable = ['nama_pt', 'batch', 'no_batch', 'tahun_batch']; 
}
