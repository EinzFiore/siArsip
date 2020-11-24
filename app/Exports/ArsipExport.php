<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;

class ArsipExport implements FromView
{
    use Exportable;
    public function kondisi(int $rak, string $box, int $batch, int $tahun)
    {
        $this->rak = $rak;
        $this->box = $box;
        $this->batch = $batch;
        $this->tahun = $tahun;
        return $this;
    }

    public function view(): View
    {
        $arsipData = [
            'rak' => $this->rak,
            'box' => $this->box,
            'batch' => $this->batch,
            'tahun' => $this->tahun
        ];
        $data['dataArsip'] = $arsip = DB::table('tb_arsip')
            ->join('dokumen', 'tb_arsip.no_pen', '=', 'dokumen.no_pen')
            ->select('tb_arsip.*', 'dokumen.nama_perusahaan', 'dokumen.tanggal_dokumen', 'dokumen.jenis_dokumen', 'dokumen.tahun_batch')
            ->where([
                ['rak', '=', $this->rak],
                ['box', '=', $this->box],
                ['tb_arsip.batch', '=', $this->batch],
                ['dokumen.tahun_batch', '=', $this->tahun],
            ])->get();

        return view('Arsip.exports.arsip', $data)->with('arsipData', $arsipData);
    }
}