<?php

namespace App\Http\Controllers;

use App\Models\DataKarung;
use App\Models\Karung;
use App\Models\Rak;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DataKarungController extends Controller
{
    private $karung;
    public function __construct(Karung $karung)
    {
        $this->karung = $karung;
    }

    public function index()
    {
        $karung = Karung::all();
        $rak = Rak::all();
        $data = [
            'karung' => $karung,
            'rak' => $rak,
        ];
        return view('Karung.list', $data);
    }

    public function getDataKarung(Request $request)
    {
        $data = DB::table('karung')
            ->leftJoin('data_karung', 'karung.no_karung', 'data_karung.no_karung')
            ->select('karung.no_karung', 'data_karung.rak', 'data_karung.box', 'data_karung.tahun', 'karung.status');
        if ($request->noKarung != null) {
            $data->where('karung.no_karung', $request->noKarung);
        }
        if ($request->rakKarung != null) {
            $data->where('data_karung.rak', $request->rakKarung);
        }
        if ($request->boxKarung != null) {
            $data->where('data_karung.box', $request->boxKarung);
        }
        if ($request->tahunKarung != null) {
            $data->where('data_karung.tahun', $request->tahunKarung);
        }
        $data = $data->get();
        $data->map(function ($data) {
            if ($data->rak == null) {
                $data->rak = "-";
            }
            if ($data->box == null) {
                $data->box = "-";
            }
            if ($data->tahun == null) {
                $data->tahun = "-";
            }
            return $data;
        });
        return DataTables::of($data)->make(true);
    }

    public function store(Request $request)
    {
        $data = $this->karung->where('no_karung', $request->karung)->first();
        if ($data) {
            return response()->json(['success' => false]);
        }
        try {
            $this->karung->create(['no_karung' => $request->karung]);
            return response()->json(['success' => true]);
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }
    }

    public function addDataKarung(Request $request)
    {
        $data = [
            'no_karung' => $request->karung,
            'rak' => $request->rak,
            'box' => $request->box,
            'tahun' => $request->tahun,
        ];
        $cek = DataKarung::where('no_karung', $request->karung)->where('rak', $request->rak)->where('box', $request->box)->where('tahun', $request->tahun)->first();
        if ($cek) {
            return response()->json(['success' => false]);
        }
        try {
            DataKarung::create($data);
            Karung::where('no_karung', $request->karung)->update(['status' => 1]);
            return response()->json(['success' => true]);
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }
    }

    public function cariDokumen(Request $request)
    {

    }
}