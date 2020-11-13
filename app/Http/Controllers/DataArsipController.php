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

    public function getDataSerahTerima(Request $request)
    {
        $search = $request->cari;

        $dataSerahTerima = DB::table('dokumen')
            ->select('no_pen', 'nama_perusahaan', 'jenis_dokumen', 'tanggal_dokumen')
            ->limit(5);

        $search = !empty($request->cari) ? ($request->cari) : ('');

        if ($search) {
            $dataSerahTerima->where('no_pen', 'like', '%' . $search . '%');
        }

        $data = $dataSerahTerima->limit(5)->get();

        $response = array();
        foreach ($data as $arsip) {
            $response[] = array(
                "value" => $arsip->no_pen,
                "perusahaan" => $arsip->nama_perusahaan,
                "jenisDok" => $arsip->jenis_dokumen,
                "tanggalDok" => $arsip->tanggal_dokumen
            );
        }
        return response()->json($response);
    }
}