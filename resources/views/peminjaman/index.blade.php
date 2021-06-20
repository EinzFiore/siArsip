@extends('layouts/app2');
@section('title', 'Data Peminjaman Dokumen | SiArsip')
@section('judul', 'Data Peminjaman')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Peminjaman BC.25</h4>
    </div>
    <div class="card-body">
      <label><strong>Filter Data Peminjaman</strong></label>
      <hr>
      <div class="row mb-2">
        <div class="col-sm-2">
          <div class="Batch">
            <label>Bulan Pinjam</label>
            <div class="form-group">
              <select name="bulan" class="form-control select2 filterPeminjaman" id="monthPinjam">
                <option value="">Pilih Bulan</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Tahun Pinjam</label>
            <div class="form-group">
              <input type="text" name="tahun" id="yearPinjam" class="form-control filterPeminjaman">
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Status</label>
            <div class="form-group">
              <select name="bulan" class="form-control select2 filterPeminjaman" id="statusPinjam">
                <option value="">Pilih Status</option>
                <option value="1">Dikembalikan</option>
                <option value="0">Dipinjam</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-plus-circle"></i>
        Tambah Data
      </button>
      <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#pengembalian"><i class="fas fa-undo"></i>
        Pengembalian BC.25
      </button>
    <div class="table-responsive">
      <table class="table table-striped data" id="peminjaman">
        <thead>
          <tr>
            <th scope="col">Nama Peminjam</th>
            <th scope="col">Nomor ND</th>
            <th scope="col">Tanggal ND</th>
            <th scope="col">Nomor Dokumen</th>
            <th scope="col">Tanggal Pinjam</th>
            <th scope="col">Tanggal Kembali</th>
            <th scope="col">Seksi</th>
            <th scope="col">Status</th>
            {{-- <th scope="col">Action</th> --}}
          </tr>
        </thead>
        <tbody>
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
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group mr-2">
                      <label>Tahun Dokumen</label>
                      <input type="number" value="" id="tahunArsip" class="form-control" name="tahunArsip">
                    </div>
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
                        <button class="btn btn-primary" id="tambahPinjam"><i class="fas fa-plus"></i></button>
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
<div class="modal fade" id="pengembalian" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cek Nomor ND</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-2">
          <div class="col-sm-6 d-flex">
            <input type="text" name="cek_nd" id="cek_no_nd" class="form-control mr-2" placeholder="Nomor ND Peminjaman">
            <button type="submit" class="btn btn-primary" id="searchND"><i class="fas fa-search"></i></button>
          </div>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#konfirmasi" id="konfirmasi" disabled>
            Konfirmasi Pengembalian
          </button>
        </div>
        <div class="box-peminjaman">
        </div>
      </div>
      <form action="" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="no_nd" value="">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="konfirmasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Dokumen : </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Tanggal Dokumen</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

{{-- Modal Detail Dokumen --}}
@foreach ($pinjam as $p)
<div class="modal fade" id="detailDokumen<?= $p->no_pen ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Dokumen : <?= $p->no_pen ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Tanggal Dokumen</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?= $p->nama_perusahaan ?></td>
              <td><?= $p->tanggal_dokumen ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endforeach
