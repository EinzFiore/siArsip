<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataArsip extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'tb_arsip';
    protected $primaryKey = 'id_dok';
    protected $fillable = [
        'no_pen', 'status', 'box', 'batch', 'rak', 'nama_pt', 'jenis_dok', 'tanggal_dok', 'user_id',
    ];

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }
}