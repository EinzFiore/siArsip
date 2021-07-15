@extends('layouts/app2');
@section('title', 'Data Karung | SiArsip')
@section('judul', 'Data Karung')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data Karung BC.25</h4>
    </div>
    <div class="card-body">
      <label><strong>Filter Data Karung</strong></label>
      <hr>
      <div class="row mb-2">
        <div class="col-sm-2">
          <div class="Batch">
            <label>Karung</label>
            <div class="form-group">
              <select name="karung" id="karungSelect" class="form-control filter-karung"> 
                <option value="">-- Pilih Karung --</option>
                @foreach ($karung as $k)
                    <option value="<?= $k->no_karung ?>"><?= $k->no_karung ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Rak</label>
            <div class="form-group">
              <select name="rak" id="rakSelect" class="form-control filter-karung"> 
                <option value="">-- Pilih Rak --</option>
                @foreach ($rak as $r)
                    <option value="<?= $r->noRak ?>"><?= $r->noRak ?></option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Box</label>
            <div class="form-group">
              <input type="text" name="box" id="boxSelect" class="form-control filter-karung" placeholder="Ketik Box">
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="Batch">
            <label>Tahun</label>
            <div class="form-group">
              <input type="number" name="tahun" id="tahunSelect" class="form-control filter-karung" placeholder="Tahun">
            </div>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahKarung">
        Tambah Data
      </button>
      <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#cariDokumen">
        Cari Dokumen
      </button>
    <div class="table-responsive">
      <table class="table table-striped" id="karung">
        <thead>
          <tr>
            <th scope="col">Nomor Karung</th>
            <th scope="col">Rak</th>
            <th scope="col">Box</th>
            <th scope="col">Tahun</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="tambahKarung" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Karung</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nomor Karung</label>
          <input type="number" name="karung" class="form-control no-karung" placeholder="Nomor Karung">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="addKarung" class="btn btn-primary">Tambah</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="cariDokumen" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-2">
          <div class="col-sm-6 d-flex">
            <input type="text" name="cek_nd" id="cek_no_nd" class="form-control mr-2" placeholder="Nomor Dokumen">
            <button type="submit" class="btn btn-primary" id="searchNoDok"><i class="fas fa-search"></i></button>
          </div>
        </div>
        <div class="box-peminjaman">
        </div>
      </div>
    </div>
  </div>
</div>


@push('script')
<script>
let karungSelect = $('#karungSelect').val();
let rakKarung = $('#rakSelect').val();
let boxKarung = $('#boxSelect').val();
let tahunKarung = $('#tahunSelect').val();
const tableKarung = $('#karung').DataTable({
    processing : true,
    rowsGroup : [0,1],
    serverside : true,
    ajax : {
      url: config.routes.getKarung,
      type: "post",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },  
      data: function(d){
        d.noKarung = karungSelect;
        d.rakKarung = rakKarung;
        d.boxKarung = boxKarung;
        d.tahunKarung = tahunKarung;
        return d
      }
    },
    columns: [
      {data: 'no_karung', name:'no_karung'},
      {data: 'rak', name:'rak'},
      {data: 'box', name:'box'},
      {data: 'tahun', name:'tahun'},
      {data: 'status', name:'status',
      render: function (data) {
        if(data == 0){
          return `<span class="badge badge-danger">Kosong</span>`;
          }
          else return `<span class="badge badge-success">Terisi</span>`;
        },
      },
      {data: 'status', name:'status',
      render: function (data, type, row) {
        return `<a href="rak/${row.rak}/${row.box}/${row.tahun}" class="btn btn-primary"><i class="fas fa-eye mr-2"></i>Lihat Rak</a>`;
      },
    },
    ]
  });

  $(".filter-karung").on('change', function(){
    karungSelect = $('#karungSelect').val();
    rakKarung = $('#rakSelect').val();
    boxKarung = $('#boxSelect').val();
    tahunKarung = $('#tahunSelect').val();
    tableKarung.ajax.reload(null,false)
  })

  $( "#addKarung" ).click(function() {
    let karung = $('.no-karung').val();
    $.ajax({
          url: `/karung`,
          type: "post",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            karung: karung,
          },
          success: function (results) {
              if (results.success === true) {
                Swal.fire(
                  'Berhasil!',
                  'Data telah ditambahkan!.',
                  'success'
                );
                setInterval(function(res){ 
                  location.reload();
              }, 1000);
              } else {
                Swal.fire(
                  'Failed!',
                  'Something error while process data.',
                  'error'
                );
              }
          }
      })
  });

  $( "#searchNoDok" ).click(function() {
  $.ajax
    ({ 
        url: `/get/arsip/${rak}/${box}/${batch}/${tahun}`,
        success: function(result)
        {
          const box = $('.box-karung');
          if(result['status'] == 'success'){
            const listData = `
            <table class="table table-borderless mt-2 listDokumen">
              <thead>
                <tr>
                  <th scope="col">Nomor Dokumen</th>
                  <th scope="col">Nama Perusahaan</th>
                  <th scope="col">Jenis Dokumen</th>
                  <th scope="col">Tanggal Dokumen</th>
                </tr>
              </thead>
              <tbody id="listDokumen">
              </tbody>
            </table>
            `
            $(box).empty();
            $(listData).appendTo(box);
            $.each(result['data'], function(key, value){
              let tbody = $('#listDokumen');
              let badge = "";
              if(value.status == 1){
                badge = '<span class="badge badge-success">Dikembalikan</span>';
              } else {
                badge = '<span class="badge badge-warning">Dipinjam</span>';
              }
              let data = `
                <tr>
                  <td>${value.no_pen}</td>
                  <td>${value.nama_pt}</td>
                  <td>${value.jenis_dok}</td>
                  <td>${value.tanggal_dok}</td>
                </tr>
              `;
              $(data).appendTo(tbody);
            });
            $('.listDokumen').DataTable();
          } else {
            const listData = `
            <div class="alert alert-danger mt-2" role="alert">
              ${result['message']}
            </div>
            `;
            $(box).empty();
            $(listData).appendTo(box);
          }
        }
    });
});
</script>
@endpush