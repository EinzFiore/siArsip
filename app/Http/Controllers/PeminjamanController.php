<?php

namespace App\Http\Controllers;

use App\Models\DataArsip;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjam = DB::table('peminjaman')
            ->join('tb_arsip', 'peminjaman.id_dok', '=', 'tb_arsip.id_dok')
            ->join('dokumen', 'peminjaman.no_pen', '=', 'dokumen.no_pen')
            ->select('peminjaman.*', 'dokumen.nama_perusahaan', 'dokumen.tanggal_dokumen', 'dokumen.jenis_dokumen', 'tb_arsip.rak', 'tb_arsip.box', 'tb_arsip.batch', 'tb_arsip.status')
            ->get();
        if ($pinjam) {
            return view('peminjaman.index', compact('pinjam'));
        } else {
            return view('peminjaman.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        foreach ($request->noDok as $key => $noPen) {
            $data = new Peminjaman();
            $data->no_pen = $noPen;
            $data->id_dok = $request->newID[$key];
            $data->nama_peminjam = $request->newNama[$key];
            $data->seksi = $request->newSeksi[$key];
            $data->tanggal_pinjam = $request->newTanggal[$key];
            $data->no_nd = $request->newNoND[$key];
            $data->tanggal_nd = $request->newTanggalND[$key];
            $data->save();

            DataArsip::where('id_dok', $request->newID[$key])->update(['status' => 2]);
            // $arsip = new DataArsip();
            // $arsip->update('')
            // DB::table('tb_arsip')
            //     ->whereIn('id_dok', $request->newID[$key])
            //     ->update(array('status' => 2));
        }
        alert()->success('Success!', 'Data Berhasil Ditambahkan!')->autoclose(3500);
        return redirect('peminjaman');
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $arsip = DataArsip::findOrFail($id);
            $peminjaman = Peminjaman::where('no_pen', $arsip->no_pen)->first();
            $dokumen = Peminjaman::where('no_nd', $peminjaman->no_nd)->select('no_pen')->get()->toArray();
            DataArsip::whereIn('no_pen', $dokumen)->update(['status' => 1]);
            DB::commit();
            alert()->success('Success!', 'Data Berhasil Dikonfirmasi!')->autoclose(3500);
            return redirect('peminjaman');
        } catch (\Exception $e) {
            DB::rollback();
            return response($e);
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
        //
    }
}