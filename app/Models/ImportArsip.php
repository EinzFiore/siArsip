<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportArsip extends Model
{
    use HasFactory;
    protected $table = "tb_importarsip";
    protected $fillable = [
        'no_pen', 'tanggal_dok', 'nama_perusahaan', 'jenis_dok', 'rak', 'box', 'batch'
    ];
}