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
      {{-- <label><strong>Filter Data Arsip</strong></label>
      <hr>
      <div class="row mb-2">
        <div class="col-sm-2">
          <div class="rak">
            <label>Rak</label>
            <div class="form-group">
              <select name="rak" class="form-control select2 filter" id="filterRak">
                <option>Pilih Rak</option>
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
                <option>Pilih Box</option>
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
              <select name="batch" class="form-control select2 filter" id="filterBatch">
                <option>Pilih Batch</option>
                @foreach ($newBatch as $b)
                <option value="<?= $b ?>"><?= $b ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Tahun</label>
            <div class="form-group">
              <select name="Tahun" class="form-control select2 filter" id="filterTahun">
                <option>Pilih Tahun</option>
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
                <option>Pilih Status</option>
                @foreach ($newStatus as $s)
                <option value="<?= $s ?>"><?= $s ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
      <hr> --}}
      <div class="table-responsive">
        <button class="btn btn-success mb-2" data-toggle="modal" data-target="#exportData">Export Excel</button>
        <table class="table display table-striped rowspan" id="arsip">
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
            {{-- @php
                $no = 1;
            @endphp
            @forelse ($arsip as $a)
              <tr>
                <td><?= $no++ ?></td>
                <td>{{$a->rak}}</td>
                <td><span class="badge badge-warning">{{$a->box}}</span></td>
                <td><span class="badge badge-secondary">{{$a->batch}}</span></td>
                <td>{{$a->jenis_dokumen}}</td>
                <td><span class="badge badge-primary">{{$a->no_pen}}</span></td>
                <td>{{$a->nama_perusahaan}}</td>
                <td>{{$a->tanggal_dokumen}}</td>
                <td>
                  @php
                    $limit = $a->tahun_batch + 10;
                      if($a->tahun_batch > $limit){
                        echo "<span class='badge badge-danger'>NonAktif</span>";
                      } elseif($a->status == 1) echo "<span class='badge badge-success'>Aktif</span>";
                      else echo "<span class='badge badge-success mb-2'>Aktif</span><span class='badge badge-warning'>Dipinjamkan</span>";
                  @endphp
                </td>
                <td>
                  <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#editArsip<?= $a->id_dok ?>">Edit</button>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#hapusArsip<?= $a->id_dok ?>">Hapus</button>
                </td>
              </tr>
              @empty
              <div class="alert alert-danger">
                Data Batch belum Tersedia.
              </div>
            @endforelse --}}
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
          <form action="<?= url('arsip/export') ?>" method="post">
            @csrf
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
                  <td><input type="number" class="form-control" name="rak"></td>
                  <td><input type="text" class="form-control" name="box"></td>
                  <td><input type="number" class="form-control" name="batch"></td>
                  <td><input type="number" class="form-control" name="tahun"></td>
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