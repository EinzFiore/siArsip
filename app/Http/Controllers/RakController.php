<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rak;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rak =  Rak::get()->all();
        return view('Rak/index', compact('rak'));
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
        $this->validate($request, [
            'noRak' => 'required',
        ]);

        Rak::create([
            'noRak' => $request->noRak,
        ]);
        alert()->success('Success!', 'Data Berhasil Ditambahkan!')->autoclose(3500);
        return redirect('rak');
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
        $this->validate($request, [
            'noRak' => 'required',
        ]);
        $rak = Rak::findOrFail($id);
        $rak->update([
            'noRak' => $request->noRak,
        ]);
        if($rak) {
            alert()->success('Success!', 'Data Berhasil Diubah!')->autoclose(3500);
            return redirect('rak');
        } else{
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
        if($rak){
            alert()->success('Success!', 'Data Berhasil Dihapus!')->autoclose(3500);
            return redirect('rak');
        } else{
            alert()->failed('Gagal!', 'Data Gagal Dihapus!')->autoclose(3500);
            return redirect('rak');
        }
    }
}
