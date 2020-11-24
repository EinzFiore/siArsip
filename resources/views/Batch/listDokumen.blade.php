@extends('layouts/app2')
@section('title', 'List Data Dokumen Batch')
@section('judul', 'List Data Dokumen Batch')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Batch</h4>
    </div>
    <div class="card-body">
      <a href="<?= route('batch') ?>" class="btn btn-warning mb-2"><i class="fas fa-backward mr-2"></i>Kembali</a>
        <button type="button" class="btn btn-primary mb-2">
            Batch <span class="badge badge-light"><?= $id ?></span>
        </button>
      {{-- <a href="{{ route('batchExport', $id) }}" class="btn btn-success mb-2"><i class="far fa-file-excel mr-2"></i>Export Excel</a> --}}
      <table class="table table-borderless data">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nomor Dokumen</th>
            <th scope="col">Nama Perusahaan</th>
            <th scope="col">Jenis Dokumen</th>
            <th scope="col">Tanggal Dokumen</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @forelse ($listDokumenBatch as $ldb)
            <tr>
                <th scope="row"><?= $no++ ?></th>
                <td><span class="badge badge-primary">{{$ldb->no_pen}}</span></td>
                <td>{{$ldb->nama_perusahaan}}</td>
                <td>{{$ldb->jenis_dokumen}}</td>
                <td>{{$ldb->tanggal_dokumen}}</td>
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