
@extends('master')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
      class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data SISWA</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data_siswa }}</div>
              </div>
              <div class="col-auto">
                <button id="data-siswa" class="btn btn-sm btn-primary">GET DATA SISWA</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data GTK</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data_gtk }}</div>
              </div>
              <div class="col-auto">
                <button id="data-gtk" class="btn btn-sm btn-success">GET DATA GTK</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">DATA SEKOLAH</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data_sekolah }}</div>
              </div>
              <div class="col-auto">
                <button id="data-sekolah" class="btn btn-sm btn-warning">GET DATA SEKOLAH</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">DATA ROMBEL</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data_rombel }}</div>
              </div>
              <div class="col-auto">
                <button id="data-rombel" class="btn btn-sm btn-danger">GET DATA ROMBEL</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Row -->

    <div class="row">

      <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Dropdown Header:</div>
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> Direct
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Social
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-info"></i> Referral
            </span>
          </div>
        </div>
        </div>
      </div>



        <div class="col-lg-6 mb-4">

          <!-- Illustrations -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
            </div>
            <div class="card-body">
              <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                src="img/undraw_posting_photo.svg" alt="...">
              </div>
              <p>Add some quality, svg illustrations to your project courtesy of <a
                target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                constantly updated collection of beautiful svg images that you can use
              completely free and without attribution!</p>
              <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
              unDraw &rarr;</a>
            </div>
          </div>
        </div>
    </div>


</div>

@endsection
@push('js_bawah')
<!-- Page level plugins -->
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }} "></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }} "></script>
<script type="text/javascript">
  $( document ).ready(function() {
    $('#data-siswa').click( function(){
      $.ajax({
       url: "{{ route('get.siswa') }}",
       method:'get',
       success: function(data){
        alert(data.success);
        },
        error: function(xhr, status, error){
          alert('Silahkan Hubungkan ke Dapodik Terlebih Dahulu');
          window.location.replace('/home');
        }
      });
    });
    $('#data-gtk').click( function(){
      $.ajax({
       url: "{{ route('get.gtk') }}",
       method:'get',
       success: function(data){
        alert(data.success);
        },
        error: function(xhr, status, error){
          alert('Silahkan Hubungkan ke Dapodik Terlebih Dahulu');
          window.location.replace('/home');
        }
      });
    });

    // $('#data-sekolah').click( function(){
    //   $.ajax({
    //    url: "",
    //    method:'get',
    //    success: function(data){
    //     alert(data.success);
    //     },
    //     error: function(xhr, status, error){
    //       alert('Silahkan Hubungkan ke Dapodik Terlebih Dahulu');
    //       window.location.replace('/home');
    //     }
    //   });
    // });
    $('#data-rombel').click( function(){
      $.ajax({
       url: "{{ route('get.rombel') }}",
       method:'get',
       success: function(data){
        alert(data.success);
        },
        error: function(xhr, status, error){
          alert('Silahkan Hubungkan ke Dapodik Terlebih Dahulu');
          window.location.replace('/home');
        }
      });
    });


  });

</script>
@endpush
