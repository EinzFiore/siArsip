@extends('layouts/app2')
@section('title','Data Perusahaan')
@section('judul','List Perusahaan')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data User</h4>
    </div>
    <div class="card-body">
      <table class="table table-striped data">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">NIP</th>
            <th scope="col">Email</th>
            <th scope="col">Team</th>
            {{-- <th scope="col">Action</th> --}}
          </tr>
        </thead>
        <?php $no = 1; ?>
        <tbody>
          @foreach ($data as $d)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$d->name}}</td>
                <td>{{$d->nip}}</td>
                <td>{{$d->email}}</td>
                <td>{{$d->team_name}}</td>
                {{-- <td>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#editPT{{$d->id}}"><i class="fas fa-user-edit"></i></button>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#hapusPT{{$d->id}}"><i class="fas fa-trash"></i></button>
                </td> --}}
              </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
  @endsection

{{-- <!-- Modal -->
<div class="modal fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="Username">
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Nama">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="email">
        </div>
        <div class="form-group">
          <label>NIP</label>
          <input type="number" name="nip" id="nip" class="form-control" placeholder="nip">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div> --}}


