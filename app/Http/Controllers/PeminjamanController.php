<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DataArsip;
use DB;

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $peminjaman = DataArsip::findOrFail($id);
        $peminjaman->update([
            'status' => 1,
        ]);
        if ($peminjaman) {
            alert()->success('Success!', 'Data Berhasil Ditambahkan!')->autoclose(3500);
            return redirect('peminjaman');
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