@extends('layouts/app2')
@section('title','Data Batch')
@section('judul','List Batch')
@section('content')
<div class="card">
  <div class="card-header">
    <h4>Data Batch</h4>
  </div>
  <div class="card-body">
    <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahBatch">Tambah Batch</button>
    <table class="table table-borderless data">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Batch</th>
          <th scope="col">Tahun</th>
          {{-- <th scope="col">Total Dokumen</th> --}}
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; ?>
        @forelse ($batch as $b)
        <tr>
          <th scope="row"><?= $no++ ?></th>
        <td>{{$b->batches}}</td>
        <td>{{$b->tahun_batch}}</td>
        {{-- <td>{{$b->tahun_batch}}</td> --}}
          <td>
            <a class="btn btn-primary" href="{{ route('batch.edit', $b->batches) }}"><i class="fas fa-eye mr-2" width="30"></i>Lihat Dokumen</a>
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
<!-- Modal -->
<div class="modal fade" id="tambahBatch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Batch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('tambahBatch') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Batch</label>
            <input type="text" class="form-control" name="batch">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Tahun</label>
            <input type="number" class="form-control" name="tahun_batch">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>