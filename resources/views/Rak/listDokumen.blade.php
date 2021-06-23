@extends('layouts/app2')
@section('title', 'List Dokumen pada Rak')
@section('judul', 'List Dokumen')
@section('content')
<div class="card">
    <div class="card-header">
      <h4>Data List Dokumen</h4>
    </div>
    <div class="card-body">
        <a href="{{ url()->previous() }}" class="btn btn-warning mb-2"><i class="fas fa-backward mr-2"></i>Kembali</a>
        <button type="button" class="btn btn-primary mb-2" disabled>
            Rak <span class="badge badge-light" id="no_rak"><?= $no_rak ?></span>
        </button>
        <button type="button" class="btn btn-info mb-2" disabled>
            Box <span class="badge badge-light" id="boxSpan"><?= $box ?></span>
        </button>
        <button type="button" class="btn btn-warning mb-2" disabled>
            Tahun <span class="badge badge-light" id="tahunSpan"><?= $year ?></span>
        </button>
        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#pindahKarung"><i class="fas fa-box-open"></i>
          Pindah ke Karung
        </button>
        <div class="table-responsive">
            <table class="table table-striped data" id="row">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">No Pen</th>
                  <th scope="col">Rak</th>
                  <th scope="col">Box</th>
                  <th scope="col">Batch</th>
                  <th scope="col">Nama Perusahaan</th>
                  <th scope="col">Tanggal Dokumen</th>
                  <th scope="col">Jenis Dokumen</th>
                  <th scope="col">Tahun</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                @forelse ($listDokumenInRak as $ld)
                <tr>
                  <th scope="row"><?= $no++ ?></th>
                  <td>{{$ld->no_pen}}</td>
                  <td>{{$ld->rak}}</td>
                  <td>{{$ld->box}}</td>
                  <td>{{$ld->batch}}</td>
                  <td>{{$ld->nama_pt}}</td>
                  <td>{{$ld->tanggal_dok}}</td>
                  <td>{{$ld->jenis_dok}}</td>
                  <td>{{$ld->tanggal_dok}}</td>
                </tr>
                @empty
                <div class="alert alert-danger">
                  Data Dokumen belum Tersedia.
              </div>
                @endforelse
              </tbody>
            </table>
        </div>
  </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="pindahKarung" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Karung</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Pilih Karung</label>
          <select name="karung" id="karungSelect" class="form-control"> 
            <option>-- Pilih Karung --</option>
            @foreach ($karung as $k)
                <option value="<?= $k->no_karung ?>"><?= $k->no_karung ?></option>
            @endforeach
          </select>
        </div>
      </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" id="btnPindahKarung" class="btn btn-primary">Pindah</button>
      </div>
    </div>
  </div>
</div>

@push('script')
    <script>
    $( "#btnPindahKarung" ).click(function() {
        let karung = $('#karungSelect').val();
        let rak = $('#no_rak').text();
        let box = $('#boxSpan').text();
        let tahun = $('#tahunSpan').text();
        $.ajax({
            url: `/karung/add/data`,
            type: "post",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              karung: karung,
              rak: rak,
              box: box,
              tahun: tahun,
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