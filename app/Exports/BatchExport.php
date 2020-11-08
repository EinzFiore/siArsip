<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Batch;

class BatchExport implements FromView
{
    public function view(): View
    {
        return view('batch.export.batch', [
            'batch' => Batch::all()
        ]);
    }
}