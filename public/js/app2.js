// variabel global Arsip
  let rak = $("#filterRak").val();
  let box = $("#filterBox").val();
  let batch = $("#filterBatch").val();
  let bulan = $("#filterBulan").val();
  let tahun = $("#filterTahun").val();
  let tahunInput = $("#filterTahunInput").val();
  let status = $("#filterStatus").val();
  let start_date = $('#start_date').val();
  let end_date = $('#end_date').val();
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
      d.start_date = start_date;
      d.end_date = end_date;
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
    {data: 'nama_pt', name:'nama_perusahaan'},
    {data: 'tanggal_dok', name:'tanggal_dok'},
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
      return `<button class="btn btn-primary mb-2" data-toggle="modal" data-target="#editArsip${data}"><i class="fas fa-pencil-alt mr-2"></i>Edit</button>
              <button class="btn btn-danger" data-toggle="modal" data-target="#hapusArsip${data}"><i class="fas fa-trash-alt mr-2"></i>Hapus</button>
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
$(document).ready(function(){
    $('.rakTable').DataTable({
      rowsGroup : [0,1,2,3,4],
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
          <button class="btn btn-danger" id="remove"><i class="fas fa-minus"></i></button>
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

// Autocomplete search no ND
$(document).ready(function(){
    $( "#cek_no_nd" ).autocomplete({
        source: function( request, response ) {
            console.log(request.term)
        $.ajax({
            // url from global config in app2.blade.php
            url:config.routes.getListND,
            type: 'post',
            dataType: "json",
            data: {
                _token: CSRF_TOKEN,
                cari: request.term,
            },
            success: function( data ) {
            response( data );
            }
        });
        },
        select: function (event, ui) {
        $("#cek_no_nd").val(ui.item.value);
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
          <input type="hidden" class="form-control idDok" name="newID[]" required readonly>
          <input type="hidden" class="form-control newNama" name="newNama[]" required readonly>
          <input type="hidden" class="form-control newSeksi" name="newSeksi[]" required readonly>
          <input type="hidden" class="form-control newTanggal" name="newTanggal[]" required readonly>
          <input type="hidden" class="form-control newNoND" name="newNoND[]" required readonly>
          <input type="hidden" class="form-control newTanggalND" name="newTanggalND[]" required readonly>
          <button class="btn btn-danger" id="remove"><i class="fas fa-minus"></i></button>
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
        <button class="btn btn-danger" id="remove"><i class="fas fa-minus"></i></button>
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
  start_date = $('#start_date').val();
  end_date = $('#end_date').val();

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

// var peminjaman
let monthPinjam = $('#monthPinjam').val();
let yearPinjam = $('#yearPinjam').val();
let statusPinjam = $('#statusPinjam').val();

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
    data: function(d){
      d.month = monthPinjam;
      d.year = yearPinjam;
      d.status = statusPinjam;
      return d
    }
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
        if(data == 0){
          return `<span class="badge badge-warning">belum kembali</span>`;
        }else return `${row.updated_at}`;
      }
    },
    {data: 'seksi', name:'seksi'},
    {data: 'status', name:'status',
    render: function (data, type, row) {
      if(data == 0){
        return `<span class="badge badge-warning">Dipinjamkan</span>`;
      }else return `<span class="badge badge-success">Dikembalikan <br> by ${row.updated_by}</span>`;
    }
  },
  ]
});

// Filter Peminjaman
$(".filterPeminjaman").on('change', function(){
  monthPinjam = $('#monthPinjam').val();
  yearPinjam = $('#yearPinjam').val();
  statusPinjam = $('#statusPinjam').val();

  tablePeminjaman.ajax.reload(null,false)
})

// Fungsi Filter PKC
$(".filterDokumen").on('change', function(){
  batch = $("#filterBatch").val();
  bulan = $("#filterBulan").val();
  tahun = $("#filterTahun").val();
  tahunInput = $("#filterTahunInput").val();

  console.log(bulan);

  tableDokumen.ajax.reload(null,false)
})

// cek data peminjaman by no nd
$( "#searchND" ).click(function() {
  let nd = $('#cek_no_nd').val();
  $.ajax
    ({ 
        url: `/get/nd/${nd}`,
        success: function(result)
        {
          const box = $('.box-peminjaman');
          if(result['status'] == 'success'){
            $('#konfirmasi').removeAttr("disabled");
            const listData = `
            <table class="table table-borderless mt-2 listPinjam">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Nomor Dokumen</th>
                  <th scope="col">Nama Peminjam</th>
                  <th scope="col">Seksi</th>
                  <th scope="col">Tanggal Pinjam</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody id="listPeminjaman">
              </tbody>
            </table>
            `
            $(box).empty();
            $(listData).appendTo(box);
            $.each(result['data'], function(key, value){
              let tbody = $('#listPeminjaman');
              let badge = "";
              if(value.status == 1){
                badge = '<span class="badge badge-success">Dikembalikan</span>';
              } else {
                badge = '<span class="badge badge-warning">Dipinjam</span>';
              }
              let data = `
                <tr>
                  <td><input type="checkbox" class="form-check-input position-static dok_id" value="${value.id}"></td>
                  <td>${value.no_pen}</td>
                  <td>${value.nama_peminjam}</td>
                  <td>${value.seksi}</td>
                  <td>${value.tanggal_pinjam}</td>
                  <td>${badge}</td>
                </tr>
              `;
              $(data).appendTo(tbody);
            });
          } else {
            $('#konfirmasi').attr("disabled","disabled");
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

$( "#konfirmasi" ).click(function() {
  let id = []
  $(".dok_id").each(function(){
    id.push($(this).val());
  });
  $('#pengembalian').modal('hide');
  Swal.fire({
    title: 'Konfirmasi pengembalian?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Konfirmasi'
  }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
          url: `/update/peminjaman`,
          dataType: 'JSON',
          data: {id: id},
          success: function (results) {
              if (results.success === true) {
                Swal.fire(
                  'Berhasil!',
                  'Data telah terkonfirmasi.',
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
    } else {
      $('#pengembalian').modal('show');
    }
  })
});

$( "#cariArsip" ).click(function() {
  let rak = $('#rak').val();
  let box = $('#box').val();
  let batch = $('#batch').val();
  let tahun = $('#tahun').val();
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

let today = new Date().toISOString().slice(0, 10);
document.getElementById('tanggal').value=today;