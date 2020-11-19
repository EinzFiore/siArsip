@extends('layouts/app2')
@section('title', 'Tambah Data Arsip')
@section('content')
<div class="row">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="container">
        <div class="card-header">
          <h4>Tambah Data Arsip</h4>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive field-wrapper">
            <form action="{{ route('dataArsip.store') }}" method="post">
              @csrf
              <div class="batch d-flex">
                <div class="form-group mr-2">
                  <label>Rak</label>
                  <select class="select2 tes" id="rak" name="rak">
                    <option>-- Pilih Rak --</option>
                    @foreach ($dataRak as $r)
                        <option value="<?= $r->noRak ?>"><?= $r->noRak ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mr-2">
                  <label>Box</label>
                  <input type="text" id="tahun" class="form-control" name="tahun_batch">
                </div>
                <div class="form-group mr-2">
                  <label>Batch</label>
                  <input type="text" id="batch" class="form-control" name="batch">
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" onchange="rakFunction()" id="selected">
                  <label class="form-check-label" for="inlineCheckbox1">Gunakan Rak</label>
                </div>
              </div>
              <table class="table table-striped table-md" id="data">
                <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nomor Dokumen</th>
                      <th>Nama Perusahaan</th>
                      <th>Jenis Dokumen</th>
                      <th>Tanggal Dokumen</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody id="kotak">
                  <tr id="rowForm">
                      <td>1</td>
                      <td><input type="number" name="noDok[]" class="form-control noDok" value="" id="noDok"></td>
                      <td><input type="text" name="namaPT[]"  class="form-control namaPT" readonly></td>
                      <td><input type="text" name="jenisDok[]" class="form-control jenisDok" readonly></td>
                      <td><input type="date" name="tanggalDok[]" class="form-control tanggalDok" readonly></td>
                      <td>
                        <button class="btn btn-primary" id="add">Tambah</button>
                      </td>
                      <input type="hidden" name="rak[]" class="form-control newRak">
                      <input type="hidden" name="box[]" class="form-control newBox">
                      <input type="hidden" name="batch[]"  class="form-control newBatch">
                  </tr>
                </tbody>
              </table>
              <div class="card-footer">
                <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>  
  </div>
</div>
@endsection
