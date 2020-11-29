<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;

class ArsipBulanan implements FromView
{
    use Exportable;
    public function kondisi(int $bulan, int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        return $this;
    }

    public function view(): View
    {
        $arsipData = [
            'bulan' => $this->bulan,
            'tahun' => $this->tahun
        ];
        $data['dataArsip'] = $arsip = DB::table('tb_arsip')
            ->join('dokumen', 'tb_arsip.no_pen', '=', 'dokumen.no_pen')
            ->select('tb_arsip.*', 'dokumen.nama_perusahaan', 'dokumen.tanggal_dokumen', 'dokumen.jenis_dokumen', 'dokumen.tahun_batch')
            ->whereMonth('tb_arsip.created_at', '=', $this->bulan)
            ->whereYear('tb_arsip.created_at', '=', $this->tahun)
            ->get();

        return view('Arsip.exports.arsipBulanan', $data)->with('arsipData', $arsipData);
    }
}