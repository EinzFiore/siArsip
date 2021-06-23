@extends('layouts/app2')
@section('title', 'List Rak | SIARSIP')
@section('judul', 'List Rak')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Rak</h4>
    </div>
    <div class="card-body">
        <a href="{{ url()->previous() }}" class="btn btn-warning mb-2"><i class="fas fa-backward mr-2"></i>Kembali</a>
      <table class="table rakTable table-striped" id="row">
        <thead>
          <tr>
            <th scope="col">Nomor Rak</th>
            <th scope="col">Box</th>
            <th scope="col">Batch</th>
            <th scope="col">Tahun</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($rak as $r)
            <tr>
                <td>{{$r->noRak}}</td>
                <td>{{$r->box}}</td>
                <td>{{$r->batch}}</td>
                <td>{{$r->tanggal_dok}}</td>
                <td>
                  <a href="{{ route('listDokumen', [$r->noRak, $r->box, $r->batch, $r->tanggal_dok]) }}" class="btn btn-primary"><i class="fas fa-eye mr-2"></i>Lihat Dokumen</a>
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

