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
                  <select class="select2" id="batch" name="batch">
                    <option>-- Pilih Rak --</option>
                    @foreach ($dataRak as $r)
                        <option value="<?= $r->noRak ?>"><?= $r->noRak ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mr-2">
                  <label>Box</label>
                  <input type="text" id="tahun" class="form-control" name="tahun_batch[]">
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" onchange="batchFunction()" id="cek">
                  <label class="form-check-label" for="inlineCheckbox1">Gunakan Batch</label>
                </div>
              </div>
              <table class="table table-striped table-md" id="data">
                <thead>
                    <tr>
                      <th></th>
                      <th>Batch</th>
                      <th>Nomor Dokumen</th>
                      <th>Nama Perusahaan</th>
                      <th>Jenis Dokumen</th>
                      <th>Tanggal Dokumen</th>
                      {{-- <th>Rak</th>
                      <th>Box</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dokumen as $dok)
                    <tr id="rowForm">
                        <td></td>
                        <td><?= $dok->batch ?></td>
                        <td><input type="number" name="noDok[]" value="<?= $dok->no_dok ?>" class="form-control" readonly></td>
                        <td><input type="text" name="namaPT[]" value="<?= $dok->nama_perusahaan ?>" class="form-control" readonly></td>
                        <td><input type="text" name="jenisDok[]" value="<?= $dok->jenis_dokumen ?>" class="form-control" readonly></td>
                        <td><input type="date" name="tanggalDok[]" value="<?= $dok->tanggal_dokumen ?>" class="form-control" readonly></td>
                        {{-- <td><input type="text" name="rak[]" id="" class="form-control"></td>
                        <td><input type="text" name="box[]" id="" class="form-control"></td> --}}
                    </tr>
                    @endforeach
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
    $(document).ready(function(){
      $('#data').DataTable({
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
      });
    });
</script>
@endsection
