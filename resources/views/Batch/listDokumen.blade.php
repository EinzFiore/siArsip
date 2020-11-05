@extends('layouts/app2')
@section('title', 'List Data Dokumen Batch')
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
      <button class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal"><i class="far fa-file-excel mr-2"></i>Export Excel</button>
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
                <td><span class="badge badge-primary">{{$ldb->no_dok}}</span></td>
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
<!-- Modal Export -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('batchExport', $id) }}" method="GET">
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Seksi PKC</label>
            <input type="text" class="form-control" name="seksiPKC">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">NIP</label>
            <input type="number" class="form-control" name="nip">
          </div>
          <div class="form-group">
            <label class="form-check-label" for="exampleCheck1">Periode Tahun Batch</label>
            <input type="text" class="form-control" name="tahunPeriode">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Export</button>
        </div>
      </form>
    </div>
  </div>
</div>