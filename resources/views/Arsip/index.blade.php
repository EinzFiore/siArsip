@extends('layouts/app2')
@section('title','Data Arsip BC.25')
@section('judul','Arsip BC.25')
@section('content')
@php
    $newBox = array_unique($box);
    $newBatch = array_unique($batch);
    $newTahun = array_unique($tahun);
    $newStatus = array_unique($status);
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
                @foreach ($rak as $r)
                <option value="<?= $r->noRak ?>"><?= $r->noRak ?></option>
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
          <div class="Batch">
            <label>Tahun Dokumen</label>
            <div class="form-group">
              <select name="Tahun" class="form-control select2 filter" id="filterTahun">
                <option value="">Pilih Tahun</option>
                @foreach ($newTahun as $t)
                <option value="<?= $t ?>"><?= $t ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Status</label>
            <div class="form-group">
              <select name="status" class="form-control select2 filter" id="filterStatus">
                <option value="">Pilih Status</option>
                <option value="1">Aktif</option>
                <option value="2">Dipinjamkan</option>
                <option value="0">NonAktif</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <label><strong>Filter Data Arsip Berdasarkan Waktu Penginputan</strong></label>
      <hr>
      <div class="row mb-2">
        <div class="col-sm-2">
          <div class="Batch">
            <label>Bulan Input</label>
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
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Tahun Input</label>
            <div class="form-group">
              <select name="tahunInput" class="form-control select2 filter" id="filterTahunInput">
                <option value="">Pilih Tahun</option>
                @foreach ($newTahun as $t)
                <option value="<?= $t ?>"><?= $t ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Tanggal Mulai</label>
            <div class="form-group">
              <input type="date" name="start_date" class="form-control filter" id="start_date">
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Tanggal Akhir</label>
            <div class="form-group">
                <input type="date" name="end_date" class="form-control filter" id="end_date">
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <button class="btn btn-success mb-2" data-toggle="modal" data-target="#exportData"><i class="fa fa-table mr-2" aria-hidden="true"></i>Export Arsip</button>
        <button class="btn btn-success mb-2" data-toggle="modal" data-target="#exportDataBulan">Export Rekap Bulanan</button>
        <table class="table display table-bordered" id="arsip">
          <thead>
            <tr>
              {{-- <th scope="col">#</th> --}}
              <th scope="col">Rak</th>
              <th scope="col">Box</th>
              <th scope="col">Batch</th>
              <th scope="col">Jenis Dokumen</th>
              <th scope="col">Nomor Pendaftaran</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Tanggal Dokumen</th>
              <th scope="col">Status Dokumen</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
  </div>
@endsection

@foreach ($arsip as $a)
<!-- Modal Edit Arsip -->
<div class="modal fade" id="editArsip<?= $a->id_dok ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Arsip : <?= $a->no_pen ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= route('dataArsip.update', $a->id_dok) ?>" method="post">
          @csrf
          @method('PUT')
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Rak</th>
                <th scope="col">Box</th>
                <th scope="col">Batch</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="number" class="form-control" name="rak" value="<?= $a->rak ?>"></td>
                <td><input type="text" class="form-control" name="box" value="<?= $a->box ?>"></td>
                <td><input type="number" class="form-control" name="batch" value="<?= $a->batch ?>"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

{{-- Modal Hapus --}}
@foreach ($arsip as $a)
  <div class="modal fade" id="hapusArsip{{$a->id_dok}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Arsip {{$a->no_pen}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('dataArsip.destroy', $a->id_dok)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
          <div class="modal-body">
              <div class="form-group" align="center">
                <h3>Yakin ingin menghapus Dokumen ini ?</h3>
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

  {{-- Export Arsip --}}
  <div class="modal fade" id="exportData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Export</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Export Data Arsip BC.25</p>
          <div class="row">
            <div class="col-sm-5">
            <form action="<?= url('arsipStatus/export') ?>" method="post">
              @csrf
              <div class="form-group">
                <label for="Status">Export Berdasarkan Status Dokumen</label>
                <select name="status" class="form-control">
                  <option value="">Pilih Status</option> 
                  <option value="0">NonAktif</option> 
                  <option value="1">Aktif</option> 
                  <option value="2">Dipinjamkan</option> 
                </select>
              </div>
              <div class="form-group">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control" placeholder="contoh : <?= date('Y') ?>">
              </div>
              <button  type="submit" class="btn btn-primary mt-2">Export</button>
            </form>
            </div>
            <div class="col-sm-6">
              <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">INFO :</h4>
                <p>Kosongkan tabel dibawah jika hanya ingin meng-export data berdasarkan status saja</p>
                <hr>
                <p class="mb-0">Untuk export berdasarkan Rak dan Box tidak perlu mengisi status</p>
              </div>
            </div>
          </div>
          <form action="<?= url('arsip/export') ?>" method="post">
            @csrf
            <h5 class="modal-title" id="exampleModalLabel">Export Data Arsip Berdasarkan Rak dan Box</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Rak</th>
                  <th scope="col">Box</th>
                  <th scope="col">Batch</th>
                  <th scope="col">Tahun</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="number" value="" class="form-control" name="rak"></td>
                  <td><input type="text" value="" class="form-control" name="box"></td>
                  <td><input type="number" value="" class="form-control" name="batch"></td>
                  <td><input type="number" value="" class="form-control" name="tahun"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Export</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Export Rekap Bulanan --}}
  <div class="modal fade" id="exportDataBulan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Export</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Export Data Arsip Per-bulan</p>
          <form action="<?= url('arsip/exportPerBulan') ?>" method="post">
            @csrf
            <div class="form-group">
              <label id="klikBulan" class="badge badge-light" data-toggle="popover" title="INFO :" data-content="Bulan harus berbentuk angka, contoh : Januari = 01">Bulan Input</label>
              <input type="number" name="bulan" class="form-control">
            </div>
            <div class="form-group">
              <label>Tahun Input</label>
              <input type="number" name="tahun" class="form-control">
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