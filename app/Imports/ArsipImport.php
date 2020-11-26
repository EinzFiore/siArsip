<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\ImportArsip;
use Maatwebsite\Excel\Concerns\ToModel;

class ArsipImport implements ToModel
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new ImportArsip([
            'no_pen' => $row[1],
            'tanggal_dok' => \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2])),
            'nama_perusahaan' => $row[3],
            'jenis_dok' => $row[4],
            'rak' => $row[5],
            'box' => $row[6],
            'batch' => $row[7],
        ]);
    }
}