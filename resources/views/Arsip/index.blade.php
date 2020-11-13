@extends('layouts/app2')
@section('title','Data Serah Terima')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Serah Terima</h4>
    </div>
    <div class="card-body">
      <table class="table data table-borderless" id="row">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nomor Pendaftaran</th>
            <th scope="col">Nama Perusahaan</th>
            <th scope="col">Tanggal Dokumen</th>
            <th scope="col">Status Dokumen</th>
            <th scope="col">Rak</th>
            <th scope="col">Box</th>
            <th scope="col">Batch</th>
            <th scope="col">Jenis Dokumen</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @forelse ($arsip as $a)
            <tr>
              <th scope="row"><?= $no++ ?></th>
              <td>{{$a->no_pen}}</td>
              <td>{{$a->nama_perusahaan}}</td>
              <td>{{$a->tanggal_dokumen}}</td>
              <td>
                @php
                    if($a->status == 0){
                      echo "<span class='badge badge-danger'>nonAktif</span>";
                    } else echo "<span class='badge badge-success'>inAktif</span>";
                @endphp
              </td>
              <td>{{$a->rak}}</td>
              <td>{{$a->box}}</td>
              <td>{{$a->batch}}</td>
              <td>{{$a->jenis_dokumen}}</td>
              
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