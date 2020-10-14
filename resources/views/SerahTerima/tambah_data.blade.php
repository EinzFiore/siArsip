@extends('layouts/app2')
@section('title', 'Tambah Data')
@section('content')
<div class="row">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="container">
        <div class="card-header">
          <h4>Tambah Data</h4>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive field-wrapper">
            <form action="{{ route('serahTerimaProses') }}" method="post">
              @csrf
              <div class="batch d-flex">
                <div class="form-group mr-2">
                  <label>Batch</label>
                  <input type="text" name="batch[]" value="{{ $tmpData['batch'] ?? "" }}">
                </div>
                <div class="form-group mr-2">
                  <label>Nomor</label>
                  <input type="text" name="nomor_batch[]" value="{{ $tmpData['no_batch'] ?? "" }}">
                </div>
                <div class="form-group">
                  <label>Tahun</label>
                  <input type="text" name="tahun[]" value="{{ $tmpData['tahun_batch'] ?? "" }}">
                </div>
              </div>
              <table class="table table-striped table-md">
                <tr>
                  <th>#</th>
                  <th>Nama Perusahaan</th>
                  <th>Nomor Dokumen</th>
                  <th>Jenis Dokumen</th>
                  <th>Tanggal</th>
                </tr>
                <tbody id="kotak">
                <?php $count = 51; ?>
                @for ($i = 1; $i < $count; $i++)
                <tr id="rowForm">
                  <td><?= $i ?></td>
                  <td>
                    <select class="form-control select2" name="nama_pt[]">
                      <option>Nama Perusahaan</option>
                      @foreach ($perusahaan as $pt)
                        <option value="{{$pt}}">{{$pt}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td><input type="number" class="form-control" placeholder="Nomor Dokumen" name="no_dokumen[]"></td>
                  <td>
                    <select class="form-control" name="jenis_dokumen[]">
                      <option>Jenis Dokumen</option>
                      @foreach ($jenisDokumen as $jenisDok)
                        <option value="{{$jenisDok}}">{{$jenisDok}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td><input type="date" class="form-control" placeholder="mm/dd/yyy" name="tanggal[]"></td>
                </tr>
                @endfor
                </tbody>
              </table>
              <div class="card-footer">
                <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- <script>
  baris = '';
  function addBaris(){
    return `
    <tr id="newBaris">
      <td>1</td>
      <td>
        <select class="form-control select2" id="select2" name="nama_pt[]">
          <option>Nama Perusahaan</option>
          @foreach ($perusahaan as $pt)
            <option value="{{$pt}}">{{$pt}}</option>
          @endforeach
        </select>
      </td>
      <td><input type="number" class="form-control" name="no_dokumen[]"></td>
      <td>
        <select class="form-control" name="jenis_dokumen[]">
          <option>Jenis Dokumen</option>
          @foreach ($jenisDokumen as $jenisDok)
            <option value="{{$jenisDok}}">{{$jenisDok}}</option>
          @endforeach
        </select>
      </td>
      <td><input type="text" class="form-control" placeholder="dd/mm/yyy" name="tanggal[]"></td>
      <td><button class="btn btn-danger" id="remove">Hapus</button></td>
    </tr>
    `;
  }

  baris += addBaris();
  $(document).ready(function(){
    function startRefresh() {
        $.get('', function(data) {
            $(document.body).html(data);    
        });
    }

    // tambah baris
    $('button#add').click(function(event){
      var tambahkotak = $('#kotak');
      event.preventDefault();	
      $(baris).appendTo(tambahkotak);
      // setTimeout(startRefresh,1000);		
    });
    
    // hapus baris
    $('body').on('click','button#remove',function(){	
      $(this).parent('tr').remove();	
    });		
  });

  // reload page

</script> --}}
@endsection
