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
            <th scope="col">Nama Perusahaan</th>
            <th scope="col">Nomor Dokumen</th>
            <th scope="col">Tanggal Dokumen</th>
            <th scope="col">Jenis Dokumen</th>
            <th scope="col">Status Dokumen</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @forelse ($serahTerima as $sr)
          <tr>
            <th scope="row"><?= $no++ ?></th>
          <td>{{$sr->nama_perusahaan}}</td>
          <td>{{$sr->no_dok}}</td>
          <td>{{$sr->tanggal_dokumen}}</td>
          <td>{{$sr->jenis_dokumen}}</td>
          <td><span class="badge badge-success">{{$sr->status}}</span></td>
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