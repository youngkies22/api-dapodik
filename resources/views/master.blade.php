

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>API DAPODIK </title>

    <!-- Custom fonts for this template-->
    <link rel="shortcut icon" rel="icon" type="image/gif/png" href="{{ asset('logo.png') }}">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style type="text/css">
        .color_mryes{
            background-color: #05405a; 
            color: white;
        }
        .center-table-mryes{
            text-align: center;
        }
        .loading {
      position: absolute;
      left: 50%;
      top: 70%;
      transform: translate(-50%,-50%);
      font: 14px arial;
      }
      .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('{{ asset("ajax-loader.gif")}}') 50% 50% no-repeat rgb(249, 249, 249);
            opacity: .8;
        }
    </style>
    @stack('js_atas')

</head>

<body id="page-top">
    <div id='pesan'></div>
    <div class='loader'>
        <div class="loading">
     <p id="pesanku" >Proses...</p>
    </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            @include('layout.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layout.navbar')
                
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
                @include('layout.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }} "></script>
    <script type="text/javascript">
        $(document).ready( function() {
            $('.loader').fadeOut('slow');
        });
    </script>
   <!--  <script type="text/javascript">
        $( document ).ready(function() {
            $.ajax({
             url: "{{ route('cek.koneksi') }}",
             method:'get',
             success: function(data){
                console.log(data);
              },
             error: function(xhr, status, error){
                 // var errorMessage = xhr.status + ': ' + xhr.statusText
                 // alert('Error - ' + errorMessage);
                 alert('Silahkan Hubungkan ke Dapodik Terlebih Dahulu');
                 window.location.replace('/home');
             }
            });
        });
        
    </script> -->
    @stack('js_bawah')

</body>

</html>