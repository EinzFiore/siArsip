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
      <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahKarung">
        Tambah Data
      </button>
      <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#pengembalian">
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


@push('script')
<script>
  // data table peminjaman
  const tableKarung = $('#karung').DataTable({
    processing : true,
    serverside : true,
    ajax : {
      url: '/karung/get',
      type: "post",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },  
      // data: function(d){
      //   d.month = monthPinjam;
      //   d.year = yearPinjam;
      //   d.status = statusPinjam;
      //   return d
      // }
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
        }else return `<span class="badge badge-success">Terisi</span>`;
      }
    },
    ]
  });

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
</script>
@endpush