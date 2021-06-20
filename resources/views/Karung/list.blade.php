@extends('layouts/app2');
@section('title', 'Data Peminjaman Dokumen | SiArsip')
@section('judul', 'Data Peminjaman')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Peminjaman BC.25</h4>
    </div>
    <div class="card-body">
      <label><strong>Filter Data Karung</strong></label>
      <hr>
      <div class="row mb-2">
        <div class="col-sm-2">
          <div class="Batch">
            <label>Tahun Pinjam</label>
            <div class="form-group">
              <input type="text" name="tahun" id="yearPinjam" class="form-control filterPeminjaman">
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Status</label>
            <div class="form-group">
              <select name="bulan" class="form-control select2 filterPeminjaman" id="statusPinjam">
                <option value="">Pilih Status</option>
                <option value="1">Dikembalikan</option>
                <option value="0">Dipinjam</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahKarung">
        Tambah Data
      </button>
      <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#pengembalian">
        Cari Dokumen
      </button>
    <div class="table-responsive">
      <table class="table table-striped data" id="karung">
        <thead>
          <tr>
            <th scope="col">Nomor Karung</th>
            <th scope="col">Tahun</th>
            <th scope="col">Total Dokumen</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
@endsection

<!-- Modal Konfirmasi -->
<div class="modal fade" id="tambahKarung" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karung</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-sm-10 d-flex">
              <input type="number" name="rak" id="rak" class="form-control mr-2" placeholder="Rak">
              <input type="text" name="box" id="box" class="form-control mr-2" placeholder="Box">
              <input type="text" name="batch" id="batch" class="form-control mr-2" placeholder="Batch">
              <input type="number" name="tahun" id="tahun" class="form-control mr-2" placeholder="Tahun">
              <button type="submit" class="btn btn-primary" id="cariArsip">Cari</button>
            </div>
          </div>
          <div class="box-karung">
          </div>
        </div>
        <form action="" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="no_nd" value="">
        </form>
      </div>
    </div>
  </div>