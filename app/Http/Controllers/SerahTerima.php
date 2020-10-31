<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Dokumen;
use App\Models\Perusahaan;
use App\Models\Batch;
use App\Models\JenisDokumen;
use Illuminate\Http\Request;

class SerahTerima extends Controller
{
    function index()
    {
        $serahTerima = Dokumen::latest()->paginate(10);
        return view('SerahTerima/index', compact('serahTerima'));
    }

    function create()
    {
        $perusahaan = Perusahaan::pluck('nama_perusahaan')->toArray();
        $jenisDokumen = JenisDokumen::pluck('jenis_dokumen')->toArray();
        $batch = Batch::pluck('batches')->toArray();
        return view('SerahTerima/tambah_data', compact('perusahaan', 'jenisDokumen', 'batch'));
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'batch' => 'required',
            'tahun_batch' => 'required',
            'nama_pt' => 'required',
            'no_dokumen' => 'required',
            'jenis_dokumen' => 'required',
            'tanggal' => 'required'
        ]);
        foreach ($request->nama_pt as $key => $nama_pt) {
            $data = new Dokumen();
            $data->nama_perusahaan = $nama_pt;
            $data->no_dok = $request->no_dokumen[$key];
            $data->jenis_dokumen = $request->jenis_dokumen[$key];
            $data->tanggal_dokumen = $request->tanggal[$key];
            $data->batch = $request->newBatch[$key];
            $data->tahun_batch = $request->newYear[$key];
            $data->save();
        }
        alert()->success('Success!', 'Data Berhasil Ditambahkan!')->autoclose(3500);
        return redirect('serahTerima');
    }
}