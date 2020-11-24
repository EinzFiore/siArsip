<?php

namespace App\Exports;

use App\Http\Controllers\SerahTerima;
use App\Models\Dokumen;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;

class SerahTerimaExport implements FromView
{
    use Exportable;
    public function kondisi(int $batch, string $nama, int $nip, int $tahun)
    {
        $this->batch = $batch;
        $this->nama = $nama;
        $this->nip = $nip;
        $this->tahun = $tahun;
        return $this;
    }

    public function view(): View
    {
        $serahTerima = [
            'batch' => $this->batch,
            'nama' => $this->nama,
            'nip' => $this->nip,
            'tahun' => $this->tahun
        ];

        $data['serahBc'] = $serah =  DB::table('dokumen')->where([
            ['batch', '=', $this->batch],
            ['dokumen.tahun_batch', '=', $this->tahun],
        ])->get();

        return view('SerahTerima.export.export', $data)->with('serahTerima', $serahTerima);
    }
}