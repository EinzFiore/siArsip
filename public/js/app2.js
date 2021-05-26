// variabel global Arsip
  let rak = $("#filterRak").val();
  let box = $("#filterBox").val();
  let batch = $("#filterBatch").val();
  let bulan = $("#filterBulan").val();
  let tahun = $("#filterTahun").val();
  let tahunInput = $("#filterTahunInput").val();
  let status = $("#filterStatus").val();
  let year = new Date().getFullYear();

// Select2 untuk form input yang memiliki class ".select2"
$(document).ready(function(){
    $( ".select2" ).select2();
});

// Tabel Arsip BC.25
const tableArsip = $('#arsip').DataTable({
  rowsGroup : [0,1,2,3,4,5,6,7],
  processing : true,
  serverside : true,
  ajax : {
    url: config.routes.getData,
    type: "post",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: function(d){
      d.rak = rak;
      d.box = box;
      d.batch = batch;
      d.tahun = tahun;
      d.bulan = bulan;
      d.tahunInput = tahunInput;
      d.status = status;
      return d
    }
  },
  columns: [
    {data: 'rak', name:'rak',
      render: function(data){
        return `<span class="badge badge-info">${data}</span>`
      }
    },
    {data: 'box', name:'box',
      render: function(data){
        return `<span class="badge badge-dark">${data}</span>`
      }
    },
    {data: 'batch', name:'batch',
      render: function(data){
        return `<span class="badge badge-light">${data}</span>`
      }
    },
    {data: 'jenis_dokumen', name:'jenis_dokumen'},
    {data: 'no_pen', name:'no_pen',
    render: function(data){
      return `<span class="badge badge-light">${data}</span>`
    }
  },
    {data: 'nama_perusahaan', name:'nama_perusahaan'},
    {data: 'tanggal_dokumen', name:'tanggal_dok'},
    {data: 'status', name:'status',
      render: function (data) {
        if(data == 1){
          return `<span class="badge badge-success">Aktif</span>`;
        } else if(data == 2){
          return `<span class="badge badge-success mb-2">Aktif</span>
                  <span class="badge badge-warning">Dipinjam</span>`;
        } else return `<span class="badge badge-danger">NonAktif</span>`
      }
    },
    {data: 'id_dok',
      render: function (data) {
      return `<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#editArsip${data}">Edit</button>
              <button class="btn btn-danger" data-toggle="modal" data-target="#hapusArsip${data}">Hapus</button>
      `;
    }
  },
  ]
});

// Tabel Import Arsip
const tableImportArsip = $('#importArsip').DataTable({
  rowsGroup : [0,1,2,3],
  processing : true,
  serverside : true,
  ajax : {
    url: config.routes.getArsipImport,
    type: "post",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: function(d){
      d.rak = rak;
      d.box = box;
      d.batch = batch;
      d.tahun = tahun;
      d.bulan = bulan;
      return d
    }
  },
  columns: [
    {data: 'rak', name:'rak',
      render: function(data){
        return `<span class="badge badge-info">${data}</span>`
      }
    },
    {data: 'box', name:'box'},
    {data: 'batch', name:'batch'},
    {data: 'jenis_dok', name:'jenis_dokumen'},
    {data: 'no_pen', name:'no_pen',
      render: function(data){
        return `<span class="badge badge-light">${data}</span>`
      }
    },
    {data: 'nama_perusahaan', name:'nama_perusahaan'},
    {data: 'tanggal_dok', name:'tanggal_dok'},
  ]
});

// Tabel Serah Terima BC.25
const tableDokumen = $('#dokumen').DataTable({
  rowsGroup : [0,1,2,3],
  processing : true,
  serverside : true,
  ajax : {
    url: config.routes.getDokumen,
    type: "post",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: function(d){
      d.batch = batch;
      d.tahun = tahun;
      d.bulan = bulan;
      d.tahunInput = tahunInput;
      return d
    }
  },
  columns: [
    {data: 'batch', name:'batch',
      render: function(data){
        return `<span class="badge badge-info">${data}</span>`
      }
    },
    {data: 'jenis_dokumen', name:'jenis_dokumen'},
    {data: 'nama_perusahaan', name:'nama_perusahaan'},
    {data: 'tanggal_dokumen', name:'tanggal_dok'},
    {data: 'no_pen', name:'no_pen',
      render: function(data){
        return `<span class="badge badge-light">${data}</span>`
      }
    },
    {data: 'no_pen',
      render: function (data) {
      return `<button class="btn btn-primary" data-toggle="modal" data-target="#editSR${data}">Edit</button>
              <button class="btn btn-danger" data-toggle="modal" data-target="#hapusSR${data}">Hapus</button>
      `;
    }
  },
  ]
});

// DataTable untuk table yang memiliki class ".data"
$(document).ready(function(){
    $('.data').DataTable();
    $('#export').DataTable({
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
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

// fungsi untuk auto fill form rak
function rakFunction() 
  { 
    if (document.getElementById('selected').checked) 
    { 
      for(let i = 0; i<100; i++){
        document.getElementsByClassName('newRak')[i].value=document.getElementById('rak').value; 
        document.getElementsByClassName('newBox')[i].value=document.getElementById('tahun').value;
        document.getElementsByClassName('newBatch')[i].value=document.getElementById('batch').value;
      }
    } 
    else
    { 
      document.getElementById('newRak').value=""; 
      document.getElementById('newBox').value=""; 
      document.getElementById('newBatch').value=""; 
    } 
  } 

// fungsi untuk auto fill form peminjaman
function pinjamFunction() 
  { 
    if (document.getElementById('selectData').checked) 
    { 
      for(let i = 0; i<100; i++){
        document.getElementsByClassName('newNama')[i].value=document.getElementById('nama').value; 
        document.getElementsByClassName('newSeksi')[i].value=document.getElementById('seksi').value;
        document.getElementsByClassName('newTanggal')[i].value=document.getElementById('tanggal').value;
        document.getElementsByClassName('newNoND')[i].value=document.getElementById('noND').value;
        document.getElementsByClassName('newTanggalND')[i].value=document.getElementById('tanggalND').value;
      }
    } 
    else
    { 
      document.getElementById('newRak').value=""; 
      document.getElementById('newBox').value=""; 
      document.getElementById('newBatch').value=""; 
    } 
  } 

// Autocomplete in form dinamis for Arsip
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){
    $( "#noDok" ).autocomplete({
        source: function( request, response ) {
            let tahunArsip = value=document.getElementById('tahunArsip').value; 
            console.log(request.term)
        $.ajax({
            // url from global config in app2.blade.php
            url:config.routes.zone,
            type: 'post',
            dataType: "json",
            data: {
                _token: CSRF_TOKEN,
                cari: request.term,
                tahun: tahunArsip,
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
      <td><input type="text" name="namaPT[]"  class="form-control namaPT" id="namaPT"></td>
      <td><input type="text" name="jenisDok[]" class="form-control jenisDok" id="jenisDok"></td>
      <td><input type="date" name="tanggalDok[]" class="form-control tanggalDok" id="tanggalDok"></td>
      <td>
        <button class="btn btn-danger" id="remove">Hapus</button>
      </td>
      <input type="hidden" name="rak[]" class="form-control newRak">
      <input type="hidden" name="box[]" class="form-control newBox">
      <input type="hidden" name="batch[]" class="form-control newBatch">
    </tr>
    `;
      $(field).appendTo(tambahkotak)
      $('.noDok').autocomplete({
              source: function( request, response ) {
              let tahunArsip = value=document.getElementById('tahunArsip').value; 
                  console.log(request.term)
              $.ajax({
                  url:config.routes.zone,
                  type: 'post',
                  dataType: "json",
                  data: {
                      _token: CSRF_TOKEN,
                      cari: request.term,
                      tahun: tahunArsip,
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

// Autocomplete in form dinamis for Peminjaman
$(document).ready(function(){
    $( "#noPen" ).autocomplete({
        source: function( request, response ) {
          let tahunArsip = value=document.getElementById('tahunArsip').value; 
            console.log(request.term)
        $.ajax({
            // url from global config in app2.blade.php
            url:config.routes.arsip,
            type: 'post',
            dataType: "json",
            data: {
                _token: CSRF_TOKEN,
                tahun: tahunArsip,
                cari: request.term,
            },
            success: function( data ) {
            response( data );
            }
        });
        },
        select: function (event, ui) {
        $(this).filter('.noDok').val(ui.item.value);
        $('.idDok').val(ui.item.id_dok);
        $('.namaPT').val(ui.item.perusahaan);
        $('.jenisDok').val(ui.item.jenisDok);
        $('.tanggalDok').val(ui.item.tanggalDok);
        return false;
        }
    });
});
  
  $(document).ready(function(){
    var count = 1;
    $('button#tambahPinjam').click(function(event){
      count++
      var tambahkotak = $('#kotak');
      event.preventDefault();
      field = `
    <tr id="newRow">
      <td>${count}</td>
      <td><input type="number" id="noPen" name="noDok[]" class="form-control noDok"></td>
      <td><input type="date" class="form-control tanggalDok" placeholder="mm/dd/yyy" name="tanggalDok[]"></td>
      <td><input type="text" name="namaPT[]" class="form-control namaPT"></td>
      <td><input type="text" name="jenisDok[]" class="form-control jenisDok"></td>
      <td>
        <input type="hidden" class="form-control idDok" name="newID[]"  required>
        <input type="hidden" class="form-control newNama" name="newNama[]" required>
        <input type="hidden" class="form-control newSeksi" name="newSeksi[]" required>
        <input type="hidden" class="form-control newTanggal" name="newTanggal[]" required>
        <input type="hidden" class="form-control newNoND" name="newNoND[]" required>
        <input type="hidden" class="form-control newTanggalND" name="newTanggalND[]" required>
        <button class="btn btn-danger" id="remove">Hapus</button>
      </td>
    </tr>
    `;
      $(field).appendTo(tambahkotak)
      $('.noDok').autocomplete({
              source: function( request, response ) {
              let tahunArsip = value=document.getElementById('tahunArsip').value; 
                  console.log(request.term)
              $.ajax({
                  url:config.routes.arsip,
                  type: 'post',
                  dataType: "json",
                  data: {
                      _token: CSRF_TOKEN,
                      tahun: tahunArsip,
                      cari: request.term
                  },
                  success: function( data ) {
                  response( data );
                  }
              });
              },
              select: function (event, ui) {
              $(this).parents("tr").find('.noDok').val(ui.item.value);
              $(this).parents("tr").find('.idDok').val(ui.item.id_dok);
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
            ${PT}
        </select>
      </td>
      <td><input type="number" class="form-control" placeholder="Nomor Dokumen" name="no_dokumen[]"></td>
      <td>
        <select class="form-control" name="jenis_dokumen[]">
          <option>Jenis Dokumen</option>
          ${jenisDok}
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

// Fungsi Filter Arsip
$(".filter").on('change', function(){
  rak = $("#filterRak").val();
  box = $("#filterBox").val();
  batch = $("#filterBatch").val();
  bulan = $("#filterBulan").val();
  tahun = $("#filterTahun").val();
  tahunInput = $("#filterTahunInput").val();
  status = $("#filterStatus").val();

  tableArsip.ajax.reload(null,false)
})

// Fungsi Filter ImportArsip
$(".filter").on('change', function(){
  rak = $("#filterRak").val();
  box = $("#filterBox").val();
  batch = $("#filterBatch").val();
  bulan = $("#filterBulan").val();
  tahun = $("#filterTahun").val();
  tableImportArsip.ajax.reload(null,false)
})

// data table peminjaman
const tablePeminjaman = $('#peminjaman').DataTable({
  processing : true,
  serverside : true,
  ajax : {
    url: config.routes.getPeminjaman,
    type: "post",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    // data: function(d){
    //   d.monthPinjam = rak;
    //   d.box = box;
    //   d.batch = batch;
    //   return d
    // }
  },
  columns: [
    {data: 'nama_peminjam', name:'nama_peminjam'},
    {data: 'no_nd', name:'no_nd'},
    {data: 'tanggal_nd', name:'tanggal_nd'},
    {data: 'no_pen', name:'no_pen',
      render: function (data) {
          return `<button class="btn btn-primary" data-toggle="modal" data-target="#detailDokumen${data}">${data}</button>`;
      }
    },
    {data: 'tanggal_pinjam', name:'tanggal_pinjam'},
    {data: 'status', name:'tanggal_kembali',
      render: function (data, type, row) {
        if(data == 2){
          return `<span class="badge badge-warning">belum kembali</span>`;
        }else return `${row.updated_at}`;
      }
    },
    {data: 'seksi', name:'seksi'},
    {data: 'status', name:'status',
    render: function (data) {
      if(data == 2){
        return `<span class="badge badge-warning">Dipinjamkan</span>`;
      }else return `<span class="badge badge-success">Dikembalikan</span>`;
    }
  },
  {data: 'status', name:'status',
     render: function (data,type,row) {
        if(data == 2){
          return ` <button class="btn btn-info mb-2" data-toggle="modal" data-target="#konfirmasi${row.no_pen}">Konfirmasi</button>`;
        }else return `-`;
      }
    },
  ]
});

// Fungsi Filter PKC
$(".filterDokumen").on('change', function(){
  batch = $("#filterBatch").val();
  bulan = $("#filterBulan").val();
  tahun = $("#filterTahun").val();
  tahunInput = $("#filterTahunInput").val();

  console.log(bulan);

  tableDokumen.ajax.reload(null,false)
})

let today = new Date().toISOString().slice(0, 10);
document.getElementById('tanggal').value=today;

