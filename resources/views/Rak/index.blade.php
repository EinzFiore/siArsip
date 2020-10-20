@extends('layouts/app2')
@section('title', 'List Rak | SIARSIP')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Rak</h4>
    </div>
    <div class="card-body">
        <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahRak">Tambah Rak</button>
      <table class="table data table-borderless" id="row">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nomor Rak</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @forelse ($rak as $r)
            <tr>
                <th scope="row"><?= $no++ ?></th>
                <td>{{$r->noRak}}</td>
                <td>
                <button class="btn btn-warning" data-toggle="modal" data-target="#editRak<?= $r->id ?>">Edit</button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#hapusRak<?= $r->id ?>">Hapus</button>
                </td>
            </tr>
          @empty
            <div class="alert alert-danger">
                Data Rak belum Tersedia.
            </div>
          @endforelse
        </tbody>
      </table>
  </div>
@endsection

<!-- Modal Tambah -->
<div class="modal fade" id="tambahRak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Rak</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('rak.store') }}" method="post">
            @csrf
            @method('POST')
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Rak</label>
                    <input type="number" class="form-control" name="noRak" placeholder="Nomor">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Rak</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@foreach ($rak as $r)
  <!-- Modal Edit -->
  <div class="modal fade" id="editRak{{$r->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Nomor Rak {{$r->noRak}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('rak.update', $r->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="modal-body">
              <div class="form-group" align="center">
                <input type="text" name="noRak" class="form-control" value="<?= $r->noRak ?>">
              </div>
            </div>
            <div class="modal-footer" align="center">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach

  @foreach ($rak as $r)
  <!-- Modal Hapus-->
  <div class="modal fade" id="hapusRak{{$r->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Nomor Rak {{$r->noRak}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('rak.destroy', $r->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
          <div class="modal-body">
              <div class="form-group" align="center">
                <h3>Yakin ingin menghapus Jenis Dokumen ini ?</h3>
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

