@extends('layouts/app2')
@section('title','Data Perusahaan')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Perusahaan</h4>
    </div>
    <div class="card-body">
      <div class="button mb-4">
        <button class="btn btn-success" data-toggle="modal" data-target="#addPT">Import Excel</button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">Tambah Data</button>
      </div>
      <table class="table table-striped data">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Perusahaan</th>
            {{-- <th scope="col">No Pendaftaran</th> --}}
            <th scope="col">Action</th>
          </tr>
        </thead>
        <?php $no = 1; ?>
        <tbody>
          @foreach ($perusahaan as $pt)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$pt->nama_perusahaan}}</td>
                <td>
                <button class="btn btn-primary" data-toggle="modal" data-target="#editPT{{$pt->id_perusahaan}}">Edit</button>
                  <button class="btn btn-danger">Delete</button>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
  @endsection

<!-- Modal Add PT -->
<div class="modal fade" id="addPT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('/perusahaan/import')}}" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            @csrf
            <label>Pilih File Excel</label>
            <div class="form-group">
              <input type="file" name="file" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Import</button>
          </div>
      </form>
    </div>
  </div>
</div>

@foreach ($perusahaan as $pt)
<!-- Modal Edit PT -->
<div class="modal fade" id="editPT{{$pt->id_perusahaan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit {{$pt->nama_perusahaan}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('/perusahaan/import')}}" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            @csrf
            <label>Entry Data Baru</label>
            <div class="form-group">
            <input type="text" placeholder="{{$pt->nama_perusahaan}}" name="nama_pt" class="form-control">
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

