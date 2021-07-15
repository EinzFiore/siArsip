<?php

namespace App\Http\Controllers;

use App\Models\DataArsip;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data['pinjam'] = DB::table('peminjaman')
            ->join('tb_arsip', 'peminjaman.id_dok', '=', 'tb_arsip.id_dok')
            ->join('dokumen', 'peminjaman.no_pen', '=', 'dokumen.no_pen')
            ->select('peminjaman.*', 'dokumen.nama_perusahaan', 'dokumen.tanggal_dokumen', 'dokumen.jenis_dokumen', 'tb_arsip.rak', 'tb_arsip.box', 'tb_arsip.batch', 'tb_arsip.status')
            ->orderBy('peminjaman.id', 'ASC')
            ->get();
        return view('peminjaman.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataPeminjaman(Request $request)
    {
        $data = DB::table('peminjaman')
            ->join('tb_arsip', 'peminjaman.id_dok', '=', 'tb_arsip.id_dok')
            ->join('dokumen', 'peminjaman.no_pen', '=', 'dokumen.no_pen')
            ->select('peminjaman.*', 'dokumen.nama_perusahaan', 'dokumen.tanggal_dokumen', 'dokumen.jenis_dokumen', 'tb_arsip.rak', 'tb_arsip.box', 'tb_arsip.batch');

        if ($request->month != null) {
            $data = $data->whereMonth('peminjaman.tanggal_pinjam', $request->month);
        }
        if ($request->year != null) {
            $data = $data->whereYear('peminjaman.tanggal_pinjam', $request->year);
        }
        if ($request->status != null) {
            $data = $data->where('peminjaman.status', $request->status);
        }

        return DataTables::of($data)->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->noDok as $key => $noPen) {
            $data = new Peminjaman();
            $data->no_pen = $noPen;
            $data->id_dok = $request->newID[$key];
            $data->nama_peminjam = $request->newNama[$key];
            $data->seksi = $request->newSeksi[$key];
            $data->tanggal_pinjam = $request->newTanggal[$key];
            $data->no_nd = $request->newNoND[$key];
            $data->tanggal_nd = $request->newTanggalND[$key];
            $data->created_by = auth()->user()->username;
            $data->save();

            DataArsip::where('id_dok', $request->newID[$key])->update(['status' => 2]);
        }
        alert()->success('Success!', 'Data Berhasil Ditambahkan!')->autoclose(3500);
        return redirect('peminjaman');
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $dokumen = Peminjaman::whereIn('id', $request->id)->select('no_pen')->get()->toArray();
            DataArsip::whereIn('no_pen', $dokumen)->update(['status' => 1]);
            $peminjaman = Peminjaman::whereIn('id', $request->id)->update(['status' => 1, 'updated_by' => auth()->user()->username]);
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false]);
        }
    }

    public function getListND(Request $request)
    {
        $search = $request->cari;
        $data = Peminjaman::select('id', 'no_nd')->groupBy('no_nd')->limit(5);
        $search = !empty($request->cari) ? ($request->cari) : ('');

        if ($search) {
            $data->where('no_nd', 'like', '%' . $search . '%');
        }

        $data = $data->limit(5)->get();

        $response = array();
        foreach ($data as $nd) {
            $response[] = array(
                "value" => $nd->no_nd,
                "id" => $nd->id,
            );
        }
        return response()->json($response);
    }

    public function getDataPeminjamanByND($nd)
    {
        $data = Peminjaman::where('no_nd', $nd)->where('status', 0)->get();
        if (count($data) > 0) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Tidak ada data peminjaman untuk nomor ND ini',
            ]);
        }
    }
}