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
                  <input type="text" name="batch[]">
                </div>
                <div class="form-group">
                  <label>Tahun</label>
                  <input type="text" name="tahun_batch[]">
                </div>
              </div>
              <table class="table table-striped table-md">
                <tr>
                  {{-- <th>#</th> --}}
                  <th>Nama Perusahaan</th>
                  <th>Nomor Dokumen</th>
                  <th>Jenis Dokumen</th>
                  <th>Tanggal</th>
                  <th>Baris</th>
                </tr>
                <tbody id="kotak">
                  <tr id="rowForm">
                    {{-- <td>1</td> --}}
                    <td>
                      <select class="form-control select2" name="nama_pt[]">
                        <option>-- Nama Perusahaan --</option>
                        @foreach ($perusahaan as $pt)
                            <option value="<?= $pt ?>"><?= $pt ?></option>
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
                    <td>
                      <button class="btn btn-primary" onclick="numberAdd()" id="add">Tambah</button>
                    </td>
                  </tr>
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
@endsection

@section('form-input')
<script>
  // i = 1;
  // function numberAdd(){
  //   i++;       
  //   document.querySelectorAll('#number').innerHTML=i;
  // };

  const baris = 
    `
      <tr id="rowForm">
        <td>
          <select class="form-control select2" name="nama_pt[]">
            <option>-- Nama Perusahaan --</option>
            @foreach ($perusahaan as $pt)
              <option value="<?= $pt ?>"><?= $pt ?></option>
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
        <td>
          <button class="btn btn-danger" id="remove">Hapus</button>
        </td>
      </tr>
    `;

  $(document).ready(function(){
    $('button#add').click(function(event){
      var tambahkotak = $('#kotak');
      event.preventDefault();
      $(baris).appendTo(tambahkotak);
      $(".select2").select2();
    });

    $('body').on('click','#remove',function(){
		$(this).parents('tr#rowForm').remove();	
	});		  
  });

</script>
@endsection
