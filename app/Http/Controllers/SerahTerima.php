<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Dokumen;
use App\Models\Perusahaan;
use App\Models\Batch;
use App\Models\JenisDokumen;
use Illuminate\Http\Request;
use App\Exports\SerahTerimaExport;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class SerahTerima extends Controller
{
    function index()
    {
        $serahTerima = Dokumen::latest()->paginate(10);
        $tahun = Dokumen::pluck('tahun_batch')->toArray();
        $batch = Dokumen::pluck('batch')->toArray();
        return view('SerahTerima/index', ['serahTerima' => $serahTerima], compact('batch', 'tahun'));
    }

    function getDataDokumen(Request $request)
    {
        $data = Dokumen::select('*');
        if ($request->input('batch') != null) {
            $data = $data->where('batch', $request->batch);
        }
        if ($request->input('tahunBatch') != null) {
            $data = $data->where('tahun_batch', $request->tahun_batch);
        }

        if ($request->input('bulan') != null) {
            $data = $data->whereMonth('created_at', $request->bulan);
        }

        if ($request->input('tahunInput') != null) {
            $data = $data->whereYear('created_at', $request->tahunInput);
        }

        return DataTables::of($data)->make(true);
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
        foreach ($request->no_dokumen as $key => $no_dokumen) {
            $cekData[] = DB::table('dokumen')->where([
                [
                    'no_pen', $no_dokumen
                ],
                ['tahun_batch', $request->newYear[$key]]
            ])->first();
            if ($cekData[$key] != null) {
                alert()->error('Failed!', 'Data Gagal Ditambahkan!')->autoclose(2500);
            } else {
                $data = new Dokumen();
                $data->nama_perusahaan = $request->nama_pt[$key];
                $data->no_pen = $no_dokumen;
                $data->jenis_dokumen = $request->jenis_dokumen[$key];
                $data->tanggal_dokumen = $request->tanggal[$key];
                $data->batch = $request->newBatch[$key];
                $data->tahun_batch = $request->newYear[$key];
                $data->tahun_resensi = $request->newYear[$key] + 10;
                $data->save();
                alert()->success('Success!', 'Data Berhasil Ditambahkan!')->autoclose(2500);
            }
        }
        return redirect('serahTerima');
    }

    function update(Request $request, $id)
    {
        $this->validate($request, [
            'batch' => 'required',
            'namaPT' => 'required',
            'noDok' => 'required',
            'tanggalDok' => 'required',
            'jenisDok' => 'required',
        ]);

        $serahTerima = Dokumen::findOrFail($id);
        $serahTerima->update([
            'batch' => $request->batch,
            'nama_perusahaan' => $request->namaPT,
            'nomor_dok' => $request->noDok,
            'tanggal_dokumen' => $request->tanggalDok,
            'jenis_dokumen' => $request->jenisDok,
        ]);
        if ($serahTerima) {
            alert()->success('Success!', 'Data Berhasil Diubah!')->autoclose(3500);
            return redirect('serahTerima');
        }
    }

    function destroy($id)
    {
        $serahTerima = Dokumen::findOrFail($id);
        $serahTerima->delete();
        if ($serahTerima) {
            alert()->success('Success!', 'Data Berhasil Dihapus!')->autoclose(3500);
            return redirect('serahTerima');
        }
    }

    function export(Request $request)
    {
        return (new SerahTerimaExport)->kondisi($request->batch, $request->nama, $request->nip, $request->tahun)
            ->download('serahterima-' . $request->batch . $request->tahun . '.xlsx');
    }
}