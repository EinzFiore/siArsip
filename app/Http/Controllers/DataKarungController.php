<?php

namespace App\Http\Controllers;

use App\Models\Karung;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DataKarungController extends Controller
{

    public function index()
    {
        return view('Karung.list');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            Karung::create($request->all());
            return response()->json(['status' => 'success']);
        } catch (QueryException $e) {
            return response()->json(['status' => 'error', 'message' => $e]);
        }
    }

}