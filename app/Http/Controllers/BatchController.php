<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    function index(){
        $batch = batch::latest()->paginate(10);
        return view('batch/list_batch', compact('batch'));
    }

    function tambahBatch(Request $request){
        $this->validate($request, [
            'batch'    => 'required',
            'no_batch' => 'required',
            'tahun_batch' => 'required'
            ]);

        // $data = [
        //     'batch' => $request->batch,
        //     'nomor' => $request->no_batch,
        //     'tahun_batch' => $request->tahun_batch
        // ];

        // dd($data);
        // die;

        $batch = Batch::create([
            'batchDoc' => $request->batch,
            'nomor' => $request->no_batch,
            'tahun_batch' => $request->tahun_batch
        ]);

        if($batch){
            return redirect()->route('bc25.create')->with(['success' => 'Batch Berhasil Dibuat!']);
        } else {
            return redirect()->route('bc25.create')->with(['error' => 'Batch Gagal Dibuat!']);
        }
    }
}
