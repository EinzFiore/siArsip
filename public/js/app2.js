// Select2 untuk form input yang memiliki class ".select2"
$(document).ready(function(){
    $( ".select2" ).select2();
});

// DataTable untuk table yang memiliki class ".data"
$(document).ready(function(){
    $('.data').DataTable();
    // $('table#row').rowspanizer();
});

// Autocomplete in form dinamis for Arsip
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){
    $( "#noDok" ).autocomplete({
        source: function( request, response ) {
            console.log(request.term)
        $.ajax({
            // url from global config in app2.blade.php
            url:config.routes.zone,
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
      $(field).appendTo(tambahkotak)
      $('.noDok').autocomplete({
              source: function( request, response ) {
                  console.log(request.term)
              $.ajax({
                  url:config.routes.zone,
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
              $(this).parents("tr").find('.noDok').val(ui.item.value);
              $(this).parents("tr").find('.namaPT').val(ui.item.perusahaan);
              $(this).parents("tr").find('.jenisDok').val(ui.item.jenisDok);
              $(this).parents("tr").find('.tanggalDok').val(ui.item.tanggalDok);
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

// fungsi untuk auto fill form batch
function batchFunction() 
  { 
    if (document.getElementById('cek').checked) 
    { 
      for(let i = 0; i<100; i++){
        document.getElementsByClassName('newBatch')[i].value=document.getElementById('batch').value; 
        document.getElementsByClassName('newYear')[i].value=document.getElementById('tahun').value;
      }
    } 
    else
    { 
      document.getElementById('newBatch').value=""; 
      document.getElementById('newYear').value=""; 
    } 
  } 

// form dinamis dengan select2 untuk form serah terima
$(document).ready(function(){
    var count = 1;
    $('button#tambah').click(function(event){
      count++
      var tambahkotak = $('#kotak');
      event.preventDefault();
      field = `
      <tr id="rowForm">
      <td>${count}</td>
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
        <input type="hidden" id="newBatch" class="form-control newBatch" name="newBatch[]" required>
        <input type="hidden" id="newYear" class="form-control newYear" name="newYear[]" required>
      <td>
        <button class="btn btn-danger" id="remove">Hapus</button>
      </td>
    </tr>
    `;
      $(field).appendTo(tambahkotak);
      $(".select2").select2();
    });
    $('body').on('click','#remove',function(){
        count--
		$(this).parents('tr#rowForm').remove();	
	});		  
  });