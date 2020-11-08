@extends('layouts/app2')
@section('title', 'Tambah Data Arsip')
@section('content')
<div class="row">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="container">
        <div class="card-header">
          <h4>Tambah Data Arsip</h4>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive field-wrapper">
            <form action="{{ route('dataArsip.store') }}" method="post">
              @csrf
              <div class="batch d-flex">
                <div class="form-group mr-2">
                  <label>Rak</label>
                  <select class="select2" id="batch" name="batch">
                    <option>-- Pilih Rak --</option>
                    @foreach ($dataRak as $r)
                        <option value="<?= $r->noRak ?>"><?= $r->noRak ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mr-2">
                  <label>Box</label>
                  <input type="text" id="tahun" class="form-control" name="tahun_batch[]">
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" onchange="batchFunction()" id="cek">
                  <label class="form-check-label" for="inlineCheckbox1">Gunakan Batch</label>
                </div>
              </div>
              <table class="table table-striped table-md" id="data">
                <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nomor Dokumen</th>
                      <th>Nama Perusahaan</th>
                      <th>Jenis Dokumen</th>
                      <th>Tanggal Dokumen</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody id="kotak">
                  <tr id="rowForm">
                      <td>1</td>
                      <td><input type="number" name="noDok[]" class="form-control noDok" value="" id="noDok"></td>
                      <td><input type="text" name="namaPT[]"  class="form-control namaPT" readonly></td>
                      <td><input type="text" name="jenisDok[]" class="form-control jenisDok" readonly></td>
                      <td><input type="date" name="tanggalDok[]" class="form-control tanggalDok" readonly></td>
                      <td>
                        <button class="btn btn-primary" id="add">Tambah</button>
                      </td>
                      <input type="hidden" name="rak[]" id="" class="form-control">
                      <input type="hidden" name="box[]" id="" class="form-control">
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

  // const baris = 
  //   `
  //   <tr id="newRow">
  //     <td></td>
  //     <td><input type="number" name="noDok[]" class="form-control noDok" value="" id="noDok"></td>
  //     <td><input type="text" name="namaPT[]"  class="form-control namaPT" id="namaPT" readonly></td>
  //     <td><input type="text" name="jenisDok[]" class="form-control jenisDok" id="jenisDok" readonly></td>
  //     <td><input type="date" name="tanggalDok[]" class="form-control tanggalDok" id="tanggalDok" readonly></td>
  //     <td>
  //       <button class="btn btn-danger" id="remove">Hapus</button>
  //     </td>
  //     <input type="hidden" name="rak[]" id="" class="form-control">
  //     <input type="hidden" name="box[]" id="" class="form-control">
  //   </tr>
  //   `;
  $(document).ready(function(){
    var count = 1;
    $('button#add').click(function(event){
      count++
      var tambahkotak = $('#kotak');
      event.preventDefault();
      field = `
    <tr id="newRow">
      <td>${count}</td>
      <td><input type="number" name="noDok[]" class="form-control noDok" value="" id="noDok"></td>
      <td><input type="text" name="namaPT[]"  class="form-control namaPT" id="namaPT" readonly></td>
      <td><input type="text" name="jenisDok[]" class="form-control jenisDok" id="jenisDok" readonly></td>
      <td><input type="date" name="tanggalDok[]" class="form-control tanggalDok" id="tanggalDok" readonly></td>
      <td>
        <button class="btn btn-danger" id="remove">Hapus</button>
      </td>
      <input type="hidden" name="rak[]" id="" class="form-control">
      <input type="hidden" name="box[]" id="" class="form-control">
    </tr>
    `;
      $(field).appendTo(tambahkotak);
      $(".noDok").autocomplete({
              source: function( request, response ) {
                  console.log(request.term)
              $.ajax({
                  url:"{{route('arsip')}}",
                  type: 'post',
                  dataType: "json",
                  data: {
                      _token: CSRF_TOKEN,
                      cari: request.term
                  },
                  success: function( data ) {
                  response( data );
                  }
              });
              },
              select: function (event, ui) {
              $(this).filter('.noDok').val(ui.item.value);
              $(this).filter('.namaPT').val(ui.item.perusahaan);
              $(this).filter('.jenisDok').val(ui.item.jenisDok);
              $(this).filter('.tanggalDok').val(ui.item.tanggalDok);
              console.log(data);
              return false;
              }
          });
    });

    $('body').on('click','#remove',function(){
      count--
		$(this).parents('tr#newRow').remove();	
	});		  
  });

</script>
<script type="text/javascript">
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $(document).ready(function(){
          $( "#noDok" ).autocomplete({
              source: function( request, response ) {
                  console.log(request.term)
              $.ajax({
                  url:"{{route('arsip')}}",
                  type: 'post',
                  dataType: "json",
                  data: {
                      _token: CSRF_TOKEN,
                      cari: request.term
                  },
                  success: function( data ) {
                  response( data );
                  }
              });
              },
              select: function (event, ui) {
              $(this).filter('.noDok').val(ui.item.value);
              $('.namaPT').val(ui.item.perusahaan);
              $('.jenisDok').val(ui.item.jenisDok);
              $('.tanggalDok').val(ui.item.tanggalDok);
              return false;
              }
          });
      });
</script>
@endsection
