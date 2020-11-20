@extends('layouts/app2')
@section('title','Data Perusahaan')
@section('judul','List Perusahaan')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Perusahaan</h4>
    </div>
    <div class="card-body">
      <div class="button mb-4">
        <button class="btn btn-success" data-toggle="modal" data-target="#addPT">Import Excel</button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPT">Tambah Data</button>
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
                  <button class="btn btn-danger" data-toggle="modal" data-target="#hapusPT{{$pt->id_perusahaan}}">Delete</button>
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
      <form action="{{ route('importPT') }}" method="post" enctype="multipart/form-data">
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

{{-- Modal tambah data --}}
<div class="modal fade" id="tambahPT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Data Perusahaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('perusahaan.store') }}" method="post">
        <div class="modal-body">
            @csrf
            <label>Entry Data Baru</label>
            <div class="form-group">
            <input type="text" placeholder="Entry Data Baru" name="namaPT" class="form-control">
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
      <form action="{{ route('perusahaan.update', $pt->id_perusahaan) }}" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            @csrf
            @method('PUT');
            <label>Entry Data Baru</label>
            <div class="form-group">
            <input type="text" placeholder="{{$pt->nama_perusahaan}}" name="namaPT" class="form-control">
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

@foreach ($perusahaan as $pt)
  <!-- Modal Hapus-->
  <div class="modal fade" id="hapusPT{{$pt->id_perusahaan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Perusahaan {{$pt->nama_perusahaan}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('perusahaan.destroy', $pt->id_perusahaan)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
          <div class="modal-body">
              <div class="form-group" align="center">
                <h3>Yakin ingin menghapus data ini ?</h3>
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
