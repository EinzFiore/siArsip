<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

use Session;
use DB;

// excel
use App\Imports\PerusahaanImport;
use Maatwebsite\Excel\Facades\Excel;

class PerusahaanController extends Controller
{
    // data perusahaan 
    function index()
    {
        $perusahaan = DB::table('perusahaan')->distinct()->get();
        return view('Perusahaan.index', compact('perusahaan'));
    }

    function getPerusahaan(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $pt = Perusahaan::orderby('nama_perusahaan', 'asc')->select('nama_perusahaan')->limit(5)->get();
        } else {
            $pt = Perusahaan::orderby('nama_perusahaan', 'asc')->select('nama_perusahaan')->where('nama_perusahaan', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($pt as $p) {
            $response[] = array(
                "text" => $p->nama_perusahaan
            );
        }

        echo json_encode($response);
        exit;
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'namaPT' => 'required',
        ]);

        Perusahaan::create([
            'nama_perusahaan' => $request->namaPT,
        ]);
        alert()->success('Success!', 'Data Berhasil Ditambahkan!')->autoclose(3500);
        return redirect('perusahaan');
    }

    function importExcel(Request $request)
    {
        // validasi file
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // Ambil file excel
        $file = $request->file('file');
        // rename file
        $nama_file = rand() . $file->getClientOriginalName();
        // upload ke file_pt
        $file->move('file_pt', $nama_file);
        // Import data
        $data =  Excel::import(new PerusahaanImport, public_path('/file_pt/' . $nama_file));
        // notif session
        Session::flash('success', 'Data Berhasil di Import');
        // redirect
        return redirect('/perusahaan');
    }

    function update(Request $request, $id)
    {
        $this->validate($request, [
            'namaPT' => 'required',
        ]);

        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->update([
            'nama_perusahaan' => $request->namaPT,
        ]);
        if ($perusahaan) {
            alert()->success('Success!', 'Data Berhasil Diubah!')->autoclose(3500);
            return redirect('perusahaan');
        }
    }

    function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();

        if ($perusahaan) {
            alert()->success('Success!', 'Data Berhasil Dihapus!')->autoclose(3500);
            return redirect('perusahaan');
        }
    }
}