@extends('layouts/app2')
@section('title','Data Batch')
@section('content')
<div class="card">
  <div class="card-header">
    <h4>Data Batch</h4>
  </div>
  <div class="card-body">
    <table class="table table-borderless data">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Batch</th>
          <th scope="col">Nomor Batch</th>
          <th scope="col">Tahun</th>
          {{-- <th scope="col">No.Surat</th> --}}
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($batch as $b)
        <tr>
          <th scope="row">1</th>
        <td>{{$b->batchDoc}}</td>
        <td>{{$b->nomor}}</td>
        <td>{{$b->tahun_batch}}</td>
        {{-- <td>{{$b->no_surat}}</td> --}}
          <td>
            <button class="btn btn-warning">Edit</button>
            <button class="btn btn-danger">Hapus</button>
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