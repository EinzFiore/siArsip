<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisDokumen;

class JDController extends Controller
{
    function index(){
        $jenisDokumen = JenisDokumen::get()->All();
        return view('JenisDokumen/index', compact('jenisDokumen'));
    }

    function store(Request $request){
        $this->validate($request, [
            'newJD' => 'required'
        ]);

        JenisDokumen::create([
            'jenis_dokumen' => $request->newJD,
        ]);
        alert()->success('Success!', 'Data Berhasil Ditambahkan!')->autoclose(3500);
        return redirect('jenisDokumen');
    }

    function update(Request $request, $id){
        $this->validate($request, [
            'editJD' => 'required'
        ]);
        $jd = JenisDokumen::findOrFail($id);
        $jd->update([
            'jenis_dokumen' => $request->editJD,
        ]);
        if($jd) {
            alert()->success('Success!', 'Data Berhasil Diubah!')->autoclose(3500);
            return redirect('jenisDokumen');
        } else{
            alert()->failed('Gagal!', 'Data Gagal Diubah!')->autoclose(3500);   
            return redirect('jenisDokumen');
        }
    }

    function destroy($id){
        $jd = JenisDokumen::findOrFail($id);
        $jd->delete();
        if($jd){
            alert()->success('Success!', 'Data Berhasil Dihapus!')->autoclose(3500);
            return redirect('jenisDokumen');
        } else{
            alert()->failed('Gagal!', 'Data Gagal Dihapus!')->autoclose(3500);
            return redirect('jenisDokumen');
        }
    }
}
