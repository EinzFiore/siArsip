<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Karung;
use App\Models\Rak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rak = DB::table('rak')
            ->leftJoin('tb_arsip as arsip', 'rak.noRak', 'arsip.rak')
            ->select('rak.noRak', 'arsip.box', 'arsip.batch', 'arsip.tanggal_dok')
            ->orderBy('rak.noRak', 'ASC')
            ->get();
        $rak->map(function ($data) {
            if ($data->tanggal_dok == null and $data->box == null and $data->batch == null) {
                $data->tanggal_dok = "-";
                $data->box = "-";
                $data->batch = "-";
            } else {
                $data->tanggal_dok = Carbon::createFromFormat('Y-m-d', $data->tanggal_dok)->format('Y');
            }
            return $data;
        });

        return view('Rak/index', compact('rak'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'noRak' => 'required',
        ]);

        Rak::create([
            'noRak' => $request->noRak,
        ]);
        alert()->success('Success!', 'Data Berhasil Ditambahkan!')->autoclose(3500);
        return redirect('rak');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'noRak' => 'required',
        ]);
        $rak = Rak::findOrFail($id);
        $rak->update([
            'noRak' => $request->noRak,
        ]);
        if ($rak) {
            alert()->success('Success!', 'Data Berhasil Diubah!')->autoclose(3500);
            return redirect('rak');
        } else {
            alert()->failed('Gagal!', 'Data Gagal Diubah!')->autoclose(3500);
            return redirect('rak');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rak = Rak::findOrFail($id);
        $rak->delete();
        if ($rak) {
            alert()->success('Success!', 'Data Berhasil Dihapus!')->autoclose(3500);
            return redirect('rak');
        }
    }

    public function listDokumen($id, $box, $batch, $year)
    {
        $listDokumenInRak = DB::table('tb_arsip')
            ->join('rak', 'tb_arsip.rak', '=', 'rak.noRak')
            ->where('tb_arsip.rak', '=', $id)
            ->where('tb_arsip.box', '=', $box)
            ->where('tb_arsip.batch', '=', $batch)
            ->whereYear('tb_arsip.tanggal_dok', '=', $year)
            ->select('tb_arsip.*')
            ->get();
        $karung = Karung::all();
        $data = [
            'no_rak' => $id,
            'box' => $box,
            'batch' => $batch,
            'year' => $year,
            'total' => count($listDokumenInRak),
            'karung' => $karung,
        ];
        return view('Rak.listDokumen', compact('listDokumenInRak'))->with($data);
    }

    public function showRak($rak, $box, $year)
    {
        $rak = DB::table('rak')
            ->leftJoin('tb_arsip as arsip', 'rak.noRak', 'arsip.rak')
            ->select('rak.noRak', 'arsip.box', 'arsip.batch', 'arsip.tanggal_dok')
            ->where('arsip.rak', '=', $rak)
            ->where('arsip.box', '=', $box)
            ->whereYear('arsip.tanggal_dok', '=', $year)
            ->orderBy('rak.noRak', 'ASC')
            ->get();
        $rak->map(function ($data) {
            if ($data->tanggal_dok == null and $data->box == null and $data->batch == null) {
                $data->tanggal_dok = "-";
                $data->box = "-";
                $data->batch = "-";
            } else {
                $data->tanggal_dok = Carbon::createFromFormat('Y-m-d', $data->tanggal_dok)->format('Y');
            }
            return $data;
        });

        return view('Rak.listRak', compact('rak'));
    }
}