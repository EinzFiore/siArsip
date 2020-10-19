<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Batch;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    function index(){
        $batch = batch::latest()->get();
        $batches = DB::table('Batch')->select('batches')->get();
        return view('batch/list_batch', compact('batch'));
    }

    function tambahBatch(Request $request){
        $this->validate($request, [
            'batch'    => 'required',
            'tahun_batch' => 'required'
        ]);

        $batch = Batch::create([
            'batches' => $request->batch,
            'tahun_batch' => $request->tahun_batch
        ]);

        if($batch){
            alert()->success('Batch telah berhasil ditambahkan !', 'Success!')->autoclose(3500);
            return redirect()->route('batch');
        } else {
            alert()->error('Batch gagal ditambahkan !', 'Gagal!')->autoclose(3500);
            return redirect()->route('batch');
        }
    }

    function edit($id){
        $listDokumenBatch = DB::table('dokumen')->where('batch', $id)->get();
        return view('batch/listDokumen', compact('listDokumenBatch'))->with('id', $id);
    }
}
