<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

  {{-- <!-- CSS Libraries -->
  <link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css">
  <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.theme.default.min.css"> --}}

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ url('stisla/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ url('stisla/assets/css/components.css')}}">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
           {{-- Header --}}
           @include('layouts/main-header')
      <div class="main-sidebar">
        {{-- Sidebar --}}
        @include('layouts/sidebar')
      </div>

      <!-- Main Content -->
      @include('layouts/main-content')
        @yield('content')
      </div>
      <footer class="main-footer">
        @include('layouts/footer')
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script type="text/javascript">
    $(document).ready(function(){
    $( ".select2" ).select2();
    });
  </script>

  @yield('form-input')
  
  <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{url('/js/jquery.rowspanizer.min.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @include('sweet::alert')
  <script>
    $(document).ready(function(){
      $('.data').DataTable();
      // $('table#row').rowspanizer();
    });
  </script>

  <script src="{{ url('stisla/assets/js/stisla.js') }}"></script>

    {{-- <!-- JS Libraies -->
    <script src="stisla/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="stisla/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="stisla/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="stisla/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="stisla/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script> --}}

    <!-- Template JS File -->
  <script src="{{ url('stisla/assets/js/scripts.js') }}"></script>
  <script src="{{ url('stisla/assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
  <script src="{{ url('stisla/assets/js/page/index.js') }}"></script>
  <script>
    //message with toastr
    @if(session()-> has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()-> has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script>

{{-- Check box --}}
<script> 
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
  </script> 

</body>
</html>
