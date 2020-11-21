@extends('layouts/app2')
@section('title', 'List Dokumen pada Rak')
@section('judul', 'List Dokumen')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data List Dokumen</h4>
    </div>
    <div class="card-body">
        <a href="<?= route('rak.index') ?>" class="btn btn-warning mb-2"><i class="fas fa-backward mr-2"></i>Kembali</a>
        <button type="button" class="btn btn-primary mb-2">
            Rak <span class="badge badge-light"><?= $id ?></span>
        </button>
        <div class="table-responsive">
            <table class="table table-striped data" id="row">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">No Pen</th>
                  <th scope="col">Rak</th>
                  <th scope="col">Box</th>
                  <th scope="col">Batch</th>
                  <th scope="col">Nama Perusahaan</th>
                  <th scope="col">Tanggal Dokumen</th>
                  <th scope="col">Jenis Dokumen</th>
                  <th scope="col">Tahun</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                @forelse ($listDokumenInRak as $ld)
                <tr>
                  <th scope="row"><?= $no++ ?></th>
                  <td>{{$ld->no_pen}}</td>
                  <td>{{$ld->rak}}</td>
                  <td>{{$ld->box}}</td>
                  <td>{{$ld->batch}}</td>
                  <td>{{$ld->nama_perusahaan}}</td>
                  <td>{{$ld->tanggal_dokumen}}</td>
                  <td>{{$ld->jenis_dokumen}}</td>
                  <td>{{$ld->tahun_batch}}</td>
                </tr>
                @empty
                <div class="alert alert-danger">
                  Data Dokumen belum Tersedia.
              </div>
                @endforelse
              </tbody>
            </table>
        </div>
  </div>
@endsection