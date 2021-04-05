@extends('layouts/app2')
@section('title','Data Perusahaan')
@section('judul','List Perusahaan')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Perusahaan</h4>
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
            <th scope="col">Action</th>
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
                <td>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#editPT{{$d->id}}">Edit</button>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#hapusPT{{$d->id}}">Delete</button>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
  @endsection


