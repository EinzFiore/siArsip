<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rak;
use App\Models\Dokumen;
use DB;

class DataArsipController extends Controller
{
    public function index()
    {
        return view('Arsip/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataRak = Rak::get();
        $dokumen = Dokumen::get()->all();
        return view('Arsip/create', compact('dataRak', 'dokumen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'namaPT' => $request->selected,
        ];
        dd($request);
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
        //
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

    function getDataSerahTerimaByID(Request $request)
    {
        $search = $request->cari;
        $dataSerahTerima = DB::table('dokumen')->select('no_dok', 'nama_perusahaan', 'jenis_dokumen', 'tanggal_dokumen');
        dd($dataSerahTerima);
        $search = !empty($request->cari) ? ($request->cari) : ('');
        if ($search) {
            $dataSerahTerima->where('no_dok', 'like', '%' . $search . '%');
        }
        $data = $dataSerahTerima->get();
        $response = array();
        foreach ($data as $serahTerima) {
            $response[] = array(
                "noDok" => $serahTerima->no_dok,
                "namaPT" => $serahTerima->nama_perusahaan,
                "jenisDok" => $serahTerima->jenis_dokumen,
                "tanggalDok" => $serahTerima->tanggal_dokumen,
            );
        }
        return response()->json($response);
    }
}