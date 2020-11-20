@extends('layouts/app2');
@section('title', 'Data Peminjaman Dokumen | SiArsip')
@section('judul', 'Data Peminjaman')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Peminjaman BC.25</h4>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#staticBackdrop">
            Tambah Data
          </button>
    <div class="table-responsive">
      <table class="table table-striped data" id="row">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nomor ND</th>
            <th scope="col">Tanggal ND</th>
            <th scope="col">Nomor Dokumen</th>
            <th scope="col">Tanggal Dokumen</th>
            <th scope="col">Nama Perusahaan</th>
            <th scope="col">Tanggal Pinjam</th>
            <th scope="col">Nama Peminjam</th>
            <th scope="col">Seksi</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @php
              $no = 1;
          @endphp
          @foreach ($pinjam as $p)
            <tr>
              <th scope="row"><?= $no++ ?></th>
              <td><?= $p->no_nd ?></td>
              <td><?= $p->tanggal_nd ?></td>
              <td><?= $p->no_pen ?></td>
              <td><?= $p->tanggal_dokumen ?></td>
              <td><?= $p->nama_perusahaan ?></td>
              <td><?= $p->tanggal_pinjam ?></td>
              <td><?= $p->nama_peminjam ?></td>
              <td><?= $p->seksi ?></td>
              <td>
                @if ($p->status == 2)
                  <span class="badge badge-warning">Dipinjamkan</span>
                  @else
                  <span class="badge badge-success">Dikembalikan</span>
                @endif
              </td>
              <td>
                <button class="btn btn-info mb-2" data-toggle="modal" data-target="#konfirmasi<?= $p->no_pen ?>">Konfirmasi</button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Peminjam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('peminjaman.store') }}" method="post">
                @csrf
                <div class="batch d-flex">
                  <div class="form-group mr-2">
                    <label>No. ND</label>
                    <input type="number" name="noND" class="form-control" id="noND">
                  </div>
                  <div class="form-group mr-2">
                    <label>Tanggal ND</label>
                    <input type="date" name="tanggalND" class="form-control" id="tanggalND">
                  </div>
                  <div class="form-group mr-2">
                    <label>Nama Peminjam</label>
                    <input type="text" name="nama" class="form-control" id="nama">
                  </div>
                  <div class="form-group mr-2">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" readonly>
                  </div>
                  <div class="form-group mr-2">
                    <label>Seksi</label>
                    <input type="text" class="form-control" name="seksi" id="seksi">
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" onchange="pinjamFunction()" id="selectData">
                    <label class="form-check-label" for="inlineCheckbox1">Gunakan</label>
                  </div>
                </div>
                <table class="table table-striped table-md">
                  <tr>
                    <th>#</th>
                    <th>Nomor Dokumen</th>
                    <th>Tanggal Dokumen</th>
                    <th>Nama Perusahaan</th>
                    <th>Jenis Dokumen</th>
                    <th>Baris</th>
                  </tr>
                  <tbody id="kotak">
                    <tr id="rowForm">
                      <td>1</td>
                      <td><input type="number" id="noPen" name="noDok[]" class="form-control noDok"></td>
                      <td><input type="date" class="form-control tanggalDok" placeholder="mm/dd/yyy" name="tanggalDok[]"></td>
                      <td><input type="text" name="namaPT[]" class="form-control namaPT"></td>
                      <td><input type="text" name="jenisDok[]" class="form-control jenisDok"></td>
                      <input type="hidden" class="form-control idDok" name="newID[]" required>
                      <input type="hidden" class="form-control newNama" name="newNama[]" required>
                      <input type="hidden" class="form-control newSeksi" name="newSeksi[]" required>
                      <input type="hidden" class="form-control newTanggal" name="newTanggal[]" required>
                      <input type="hidden" class="form-control newNoND" name="newNoND[]" required>
                      <input type="hidden" class="form-control newTanggalND" name="newTanggalND[]" required>
                      <td>
                        <button class="btn btn-primary" id="tambahPinjam">Tambah</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>

<!-- Modal Konfirmasi -->
@foreach ($pinjam as $p)
<div class="modal fade" id="konfirmasi<?= $p->no_pen ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pengembalian Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Konfirmasi dokumen <?= $p->no_pen ?> dengan nomor ND <?= $p->no_nd ?>?
      </div>
      <form action="<?= route('peminjaman.update', $p->id_dok) ?>" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach