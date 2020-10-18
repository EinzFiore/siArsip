@extends('layouts/app2')
@section('title','Data Serah Terima BC25')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Batch</h4>
    </div>
    <div class="card-body">
      <table class="table data table-borderless">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nomor Surat</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($serahTerima as $sr)
          <tr>
            <th scope="row">1</th>
          <td>{{$sr->no_surat}}</td>
          <td>{{$sr->tanggal}}</td>
            <td>
              <button class="btn btn-warning">Edit</button>
              <button class="btn btn-danger">Hapus</button>
            </td>
          </tr>
          @empty
          <div class="alert alert-danger">
            Data Batch belum Tersedia.
        </div>
          @endforelse
        </tbody>
      </table>
  </div>
@endsection