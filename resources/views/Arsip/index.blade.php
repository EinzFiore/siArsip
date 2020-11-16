@extends('layouts/app2')
@section('title','Data Serah Terima')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Serah Terima</h4>
    </div>
    <div class="card-body">
      <table class="table display table-striped rowspan" id="arsip">
        <thead>
          <tr>
            <th scope="col">#</th>
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
          @php
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
                    if($a->status == 0){
                      echo "<span class='badge badge-danger'>NonAktif</span>";
                    } elseif($a->status == 1) echo "<span class='badge badge-success'>Aktif</span>";
                    else echo "<span class='badge badge-warning'>Dipinjamkan</span>";
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
          @endforelse
        </tbody>
      </table>
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
