@extends('layouts/app2')
@section('title', 'Tambah Data')
@section('judul', 'Tambah Serah Terima')
@section('content')
<div class="row">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="container">
        <div class="card-header">
          <h4>Tambah Data</h4>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive field-wrapper">
            <form action="{{ route('serahTerima.store') }}" method="post">
              @csrf
              <div class="batch d-flex">
                <div class="form-group mr-2">
                  <label>Batch</label>
                  <select class="select2" id="batch" name="batch">
                    <option>-- Pilih Batch --</option>
                    @foreach ($batch as $b)
                        <option value="<?= $b ?>"><?= $b ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mr-2">
                  <label>Tahun</label>
                  <input type="text" id="tahun" class="form-control" name="tahun_batch[]">
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" onchange="batchFunction()" id="cek">
                  <label class="form-check-label" for="inlineCheckbox1">Gunakan Batch</label>
                </div>
              </div>
              <table class="table table-striped table-md">
                <tr>
                  <th>#</th>
                  <th>Nama Perusahaan</th>
                  <th>Nomor Dokumen</th>
                  <th>Jenis Dokumen</th>
                  <th>Tanggal Dokumen</th>
                  <th>Baris</th>
                </tr>
                <tbody id="kotak">
                  <tr id="rowForm">
                    <td>1</td>
                    <td>
                      <select class="form-control select2" name="nama_pt[]">
                        <option>-- Nama Perusahaan --</option>
                        @foreach ($perusahaan as $pt)
                            <option value="<?= $pt ?>"><?= $pt ?></option>
                        @endforeach
                      </select>
                    </td>
                    <td><input type="number" class="form-control" placeholder="Nomor Dokumen" name="no_dokumen[]"></td>
                    <td>
                      <select class="form-control" name="jenis_dokumen[]">
                        <option>Jenis Dokumen</option>
                        @foreach ($jenisDokumen as $jenisDok)
                          <option value="{{$jenisDok}}">{{$jenisDok}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td><input type="date" class="form-control" placeholder="mm/dd/yyy" name="tanggal[]"></td>
                    <input type="hidden" class="form-control newBatch" name="newBatch[]" required>
                    <input type="hidden" class="form-control newYear" name="newYear[]" required>
                    <td>
                      <button class="btn btn-primary" id="tambah">Tambah</button>
                    </td>
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
<script>
      var jenisDok = `@foreach ($jenisDokumen as $jenisDok)
            <option value='{{$jenisDok}}'>{{$jenisDok}}</option>
            @endforeach`;
            
    var PT = `@foreach ($perusahaan as $pt)
            <option value="<?= $pt ?>"><?= $pt ?></option>
          @endforeach`;
</script>
@endsection
