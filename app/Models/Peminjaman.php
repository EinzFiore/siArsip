<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = "peminjaman";
    protected $fillable = [
        'id_dok', 'no_pen', 'nama_peminjam', 'seksi', 'tanggal_pinjam', 'tanggal_selesai', 'no_nd', 'tanggal_nd', 'updated_by', 'created_by',
    ];
}