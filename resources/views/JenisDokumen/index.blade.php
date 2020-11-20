@extends('layouts/app2')
@section('title', 'Jenis Dokumen | SIARSIP')
@section('judul', 'List Jenis Dokumen')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Jenis Dokumen</h4>
    </div>
    <div class="card-body">
      <div class="button mb-4">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addJD">Tambah Data</button>
      </div>
      @error('title')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
      <table class="table table-borderless data">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Jenis Dokumen</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <?php $no = 1; ?>
        <tbody>
          @foreach ($jenisDokumen as $jd)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$jd->jenis_dokumen}}</td>
                <td>
                <button class="btn btn-primary" data-toggle="modal" data-target="#editJD{{$jd->id}}">Edit</button>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#deleteJD{{$jd->id}}">Delete</button>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
@endsection
<!-- Modal Add PT -->
<div class="modal fade" id="addJD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Dokumen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('jenisDokumen.store')}}" method="post" enctype="multipart/form-data">
          <div class="modal-body">
              @csrf
              <label>Jenis Dokumen Baru</label>
              <div class="form-group">
                <input type="text" name="newJD" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  
  @foreach ($jenisDokumen as $jd)
  <!-- Modal Edit PT -->
  <div class="modal fade" id="editJD{{$jd->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{$jd->jenis_dokumen}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('jenisDokumen.update', $jd->id)}}" method="post" enctype="multipart/form-data">
          <div class="modal-body">
              @csrf
              @method('PUT')
              <label>Entry Data Baru</label>
              <div class="form-group">
              <input type="text" placeholder="{{$jd->jenis_dokumen}}" name="editJD" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Edit Data</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach

  @foreach ($jenisDokumen as $jd)
  <!-- Modal Hapus-->
  <div class="modal fade" id="deleteJD{{$jd->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Jenis Dokumen {{$jd->jenis_dokumen}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('jenisDokumen.destroy', $jd->id)}}" method="POST" enctype="multipart/form-data">
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