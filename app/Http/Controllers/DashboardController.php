<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        $totalUsers = count($users);

        $arsip = DB::table('tb_arsip')->get();
        $totalArsip = count($arsip);

        $dokumen = DB::table('dokumen')->get();
        $totalDokumen = count($dokumen);

        $pinjam = DB::table('peminjaman')->get();
        $totalPinjam = count($pinjam);
        return view('dashboard', compact('totalUsers', 'totalArsip', 'totalDokumen', 'totalPinjam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userList()
    {
        $user['data'] = DB::table('users')
            ->join('team_user', 'users.id', 'team_user.user_id')
            ->join('teams', 'team_user.team_id', 'teams.id')
            ->select('users.name', 'users.id', 'users.email', 'teams.name as team_name', 'users.nip')
            ->groupBy('users.id')
            ->get();
        return view('userList', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}