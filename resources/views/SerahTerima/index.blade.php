@extends('layouts/app2')
@section('title','Data Serah Terima')
@section('judul', 'List Serah Terima')
@section('content')
@php
    $newBatch = array_unique($batch);
    $newTahun = array_unique($tahun);
@endphp
<div class="card">
    <div class="card-header">
      <h4>Data Serah Terima</h4>
    </div>
    <div class="card-body">
      <label><strong>Filter Data Serah Terima</strong></label>
      <hr>
      <div class="row mb-2">
        <div class="col-sm-2">
          <div class="batch">
            <label>Batch</label>
            <div class="form-group">
              <select name="batch" class="form-control select2 filterDokumen" id="filterBatch">
                <option value="">Pilih Batch</option>
                @foreach ($newBatch as $b)
                <option value="<?= $b ?>"><?= $b ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="box">
            <label>Tahun Batch</label>
            <div class="form-group">
              <select name="tahunBatch" class="form-control select2 filterDokumen" id="filterTahun">
                <option value="">Pilih Tahun</option>
                @foreach ($newTahun as $n)
                <option value="<?= $n ?>"><?= $n ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Bulan Input</label>
            <div class="form-group">
              <select name="bulan" class="form-control select2 filterDokumen" id="filterBulan">
                <option value="">Pilih Bulan</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Tahun Input</label>
            <div class="form-group">
              <select name="tahunInput" class="form-control select2 filterDokumen" id="filterTahunInput">
                <option value="">Pilih Tahun</option>
                @foreach ($newTahun as $n)
                <option value="<?= $n ?>"><?= $n ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <button class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal"><i class="far fa-file-excel mr-2"></i>Export Excel</button>
      <table class="table table-bordered" id="dokumen">
        <thead>
          <tr>
            <th scope="col">Batch</th>
            <th scope="col">Jenis Dokumen</th>
            <th scope="col">Nama Perusahaan</th>
            <th scope="col">Tanggal Dokumen</th>
            <th scope="col">Nomor Dokumen</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
  </div>
@endsection

<!-- Modal Edit -->
@foreach ($serahTerima as $sr)
<div class="modal fade" id="editSR{{$sr->no_pen}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Nomor Dokumen : <span class="badge badge-primary"><?= $sr->no_pen ?></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('serahTerima.update', $sr->id) }}" method="post">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Batch:</label>
                <input type="text" class="form-control" value="<?= $sr->batch ?>" name="batch">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Nama Perusahaan:</label>
                <input type="text" name="namaPT" value="<?= $sr->nama_perusahaan ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Nomor Dokumen:</label>
                <input type="text" name="noDok" value="<?= $sr->no_pen ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Tanggal Dokumen:</label>
                <input type="date" name="tanggalDok" value="<?= $sr->tanggal_dokumen ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Jenis Dokumen:</label>
                <input type="text" name="jenisDok" value="<?= $sr->jenis_dokumen ?>" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Edit Data</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endforeach

@foreach ($serahTerima as $sr)
<div class="modal fade" id="hapusSR{{$sr->no_pen}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Hapus Dokumen {{$sr->no_pen}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('serahTerima.destroy', $sr->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('DELETE')
        <div class="modal-body">
            <div class="form-group" align="center">
              <h2>Yakin ingin menghapus dokumen ini ?</h2>
              <img src="{{url('/img/delete.png')}}" width="50%">
            </div>
          </div>
          <div class="modal-footer" align="center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus Data</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endforeach
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
        <form action="<?= route('exportST') ?>" method="post">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Seksi PKC</label>
            <input type="text" class="form-control" value="<?= auth()->user()->name ?>" name="nama">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">NIP</label>
            <input type="number" class="form-control" value="<?= auth()->user()->nip ?>" name="nip">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Batch</label>
            <input type="number" class="form-control" name="batch">
          </div>
          <div class="form-group">
            <label class="form-check-label" for="exampleCheck1">Periode Tahun Batch</label>
            <input type="text" class="form-control" name="tahun">
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