@extends('layouts/app2')
@section('title', 'List Data Import BC.25')
@section('judul', 'Data Import BC.25')
@section('content')
@php
    $newRak = array_unique($rak);
    $newBox = array_unique($box);
    $newBatch = array_unique($batch);
@endphp
<div class="card">
    <div class="card-header">
      <h4>Data Arsip</h4>
    </div>
    <div class="card-body">
      <label><strong>Filter Data Arsip</strong></label>
      <hr>
      <div class="row mb-2">
        <div class="col-sm-2">
          <div class="rak">
            <label>Rak</label>
            <div class="form-group">
              <select name="rak" class="form-control select2 filter" id="filterRak">
                <option value="">Pilih Rak</option>
                @foreach ($newRak as $r)
                <option value="<?= $r ?>"><?= $r ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="box">
            <label>Box</label>
            <div class="form-group">
              <select name="box" class="form-control select2 filter" id="filterBox">
                <option value="">Pilih Box</option>
                @foreach ($newBox as $b)
                <option value="<?= $b ?>"><?= $b ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Batch</label>
            <div class="form-group">
              <select name="newBatch" class="form-control select2 filter" id="filterBatch">
                <option value="">Pilih Batch</option>
                @foreach ($newBatch as $b)
                <option value="<?= $b ?>"><?= $b ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <label>Bulan Dokumen</label>
          <div class="form-group">
            <select name="bulan" class="form-control select2 filter" id="filterBulan">
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
        <div class="col-sm-2">
          <div class="Batch">
            <label>Tahun Dokumen</label>
            <div class="form-group">
              <input type="text" name="tahun" id="filterTahun" class="form-control filter">
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <button class="btn btn-success mb-2" data-toggle="modal" data-target="#importData"><i class="fas fa-file-import mr-2"></i>Import Data</button>
        <table class="table display table-bordered" id="importArsip">
          <thead>
            <tr>
              <th scope="col">Rak</th>
              <th scope="col">Box</th>
              <th scope="col">Batch</th>
              <th scope="col">Jenis Dokumen</th>
              <th scope="col">Nomor Pendaftaran</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Tanggal Dokumen</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
  </div>
@endsection
<!-- Modal Add PT -->
<div class="modal fade" id="importData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import Data Arsip BC.25</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('importData') }}" method="post" enctype="multipart/form-data">
          <div class="modal-body">
              @csrf
              <label>Pilih File Excel</label>
              <div class="form-group">
                <input type="file" name="file" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </form>
      </div>
    </div>
  </div>