<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';
    protected $fillable = [
        'no_dok','no_batch','nama_perusahaan','tanggal_daftar','jenis_dokumen','status','update'
    ];
}
