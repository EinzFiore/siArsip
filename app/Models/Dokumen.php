<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'dokumen';
    protected $fillable = [
        'no_pen', 'nama_perusahaan', 'jenis_dokumen', 'tanggal_dokumen', 'batch', 'tahun_batch'
    ];

    function dataArsip()
    {
        return $this->belongsToMany(DataArsip::class);
    }
}