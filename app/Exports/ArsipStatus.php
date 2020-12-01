<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;

class ArsipStatus implements FromView
{
    use Exportable;
    public function kondisi(int $tahun, int $status)
    {
        $this->tahun = $tahun;
        $this->status = $status;
        return $this;
    }

    public function view(): View
    {
        $arsipData = [
            'tahun' => $this->tahun,
            'status' => $this->status
        ];

        $data['dataArsip'] = $arsip = DB::table('tb_arsip')
            ->join('dokumen', 'tb_arsip.no_pen', '=', 'dokumen.no_pen')
            ->select('tb_arsip.*', 'dokumen.nama_perusahaan', 'dokumen.tanggal_dokumen', 'dokumen.jenis_dokumen', 'dokumen.tahun_batch')
            ->where([
                ['tb_arsip.status', '=', $this->status],
                ['dokumen.tahun_batch', '=', $this->tahun],
            ])->get();

        return view('Arsip.exports.arsip2', $data)->with('arsipData', $arsipData);
    }
}