@extends('layouts/app2');
@section('title', 'Data Peminjaman Dokumen | SiArsip')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Serah Terima</h4>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#staticBackdrop">
            Tambah Data
          </button>
      <table class="table table-striped data" id="row">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Peminjam</th>
            <th scope="col">Seksi</th>
            <th scope="col">Nomor Dokumen</th>
            <th scope="col">Nama Perusahaan</th>
            <th scope="col">Tanggal Dokumen</th>
            <th scope="col">Tanggal Pinjam</th>
            <th scope="col">Tanggal Kembali</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Ferdinand</td>
            <td>PKC</td>
            <td>0023090</td>
            <td>PT Eins Trend</td>
            <td>12/02/2020</td>
            <td>16/11/2020</td>
            <td>-</td>
            <td>Belum Kembali</td>
            <td>
              <button class="btn btn-warning mb-2" data-toggle="modal" data-target="#editSR">Edit</button>
            </td>
          </tr>
          {{-- <div class="alert alert-danger">
            Data Batch belum Tersedia.
        </div> --}}
          {{-- @endforelse --}}
        </tbody>
      </table>
  </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Peminjam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('peminjaman.store') }}" method="post">
                @csrf
                <div class="batch d-flex">
                  <div class="form-group mr-2">
                    <label>Nama Peminjam</label>
                    <input type="text" name="nama" class="form-control">
                  </div>
                  <div class="form-group mr-2">
                    <label>Seksi</label>
                    <input type="text" class="form-control" name="seksi">
                  </div>
                  <div class="form-group mr-2">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="seksi">
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" onchange="batchFunction()" id="cek">
                    <label class="form-check-label" for="inlineCheckbox1">Gunakan data</label>
                  </div>
                </div>
                <table class="table table-striped table-md">
                  <tr>
                    <th>#</th>
                    <th>Nomor Dokumen</th>
                    <th>Nama Perusahaan</th>
                    <th>Jenis Dokumen</th>
                    <th>Tanggal Dokumen</th>
                    <th>Baris</th>
                  </tr>
                  <tbody id="kotak">
                    <tr id="rowForm">
                      <td>1</td>
                      <td><input type="number" id="noPen" name="noDok[]" class="form-control noDok"></td>
                      <td><input type="text" name="namaPT[]" class="form-control namaPT"></td>
                      <td><input type="text" name="jenisDok[]" class="form-control jenisDok"></td>
                      <td><input type="date" class="form-control tanggalDok" placeholder="mm/dd/yyy" name="tanggalDok[]"></td>
                      <input type="hidden" class="form-control newBatch" name="newNama[]" required>
                      <input type="hidden" class="form-control newYear" name="newSeksi[]" required>
                      <input type="hidden" class="form-control newYear" name="newTanggal[]" required>
                      <td>
                        <button class="btn btn-primary" id="tambahPinjam">Tambah</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>