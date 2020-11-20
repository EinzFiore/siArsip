<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class ArsipExport implements FromView
{
    public function view(): View
    {
        $data['dataArsip'] = $arsip = DB::table('tb_arsip')
            ->join('dokumen', 'tb_arsip.no_pen', '=', 'dokumen.no_pen')
            ->select('tb_arsip.*', 'dokumen.nama_perusahaan', 'dokumen.tanggal_dokumen', 'dokumen.jenis_dokumen')
            ->get();
        return view('Arsip.exports.arsip', $data);
    }
}