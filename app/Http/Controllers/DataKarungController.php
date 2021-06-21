<?php

namespace App\Http\Controllers;

use App\Models\Karung;
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
        return view('Karung.list');
    }

    public function getDataKarung(Request $request)
    {
        $data = DB::table('karung')
            ->leftJoin('data_karung', 'karung.no_karung', 'data_karung.no_karung')
            ->select('karung.no_karung', 'data_karung.rak', 'data_karung.box', 'data_karung.tahun', 'karung.status')
            ->get();
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
        try {
            $this->karung->create(['no_karung' => $request->karung]);
            return response()->json(['success' => true]);
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }
    }

}