<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Dokumen;
use App\Models\Perusahaan;
// use App\Models\tmpDataBatch;
use App\Models\JenisDokumen;
use App\Models\serah_terima;
use Illuminate\Http\Request;

class SerahTerima extends Controller
{
    function index(){
        $serahTerima = serah_terima::latest()->paginate(10);
        return view('SerahTerima/index', compact('serahTerima'));
    }

    function create(){
        // $tmpData = tmpDataBatch::first();
        $perusahaan = Perusahaan::pluck('nama_perusahaan')->toArray();
        $jenisDokumen = JenisDokumen::pluck('jenis_dokumen')->toArray();
        return view('SerahTerima/tambah_data', compact('perusahaan','jenisDokumen'));
    }

    // function tmpData(Request $request){
    //     $this->validate($request, [
    //         'nama_pt' => 'required',
    //         'batch' => 'required',
    //         'nomor' => 'required',
    //         'tahun' => 'required',
    //     ]);

    //     $tmpData = tmpDataBatch::create([
    //         'nama_pt' => $request->nama_pt,
    //         'batch' => $request->batch,
    //         'no_batch' => $request->nomor,
    //         'tahun_batch' => $request->tahun,
    //     ]);

    //     if($tmpData){
    //         return redirect()->route('SerahTerima.create')->with(['success' => 'Data Berhasil Dibuat !']);
    //     } else {
    //         return redirect()->route('SerahTerima.create')->with(['error' => 'Data Gagal Dibuat !']);
    //     }

    // }

    function createProses(Request $request){
        $this->validate($request, [
            'batch' => 'required',
            'nomor_batch' => 'required',
            'tahun' => 'required',
            'nama_pt' => 'required',
            'no_dokumen' => 'required',
            'jenis_dokumen' => 'required',
            'tanggal' => 'required'
        ]);

        foreach ($request->nama_pt as $key =>$nama_pt) {
            $data = new Dokumen();
            $data->nama_perusahaan = $nama_pt;
            $data->no_dok = $request->no_dokumen[$key];
            // $data->no_batch = $request->nomor_batch[$key];
            $data->jenis_dokumen = $request->jenis_dokumen[$key];
            $data->tanggal_dokumen = $request->tanggal[$key];
            $data->save();
        }
    }
}
