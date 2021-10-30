
@extends('master')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
  <p class="mb-4">{{ $pesan}} <br>
    <!-- <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $titlebar }}</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>ROMBEL</th>
                <th>NIS</th>
                <th>NISN</th>
                <th>JSK</th>
                <th>TEMPAT LAHIR</th>
                <th>TGL LAHIR</th>
                <th>AGAMA</th>
                <th>HP SISWA</th>
                <th>IBU</th>
                <th>AYAH</th>
                
              </tr>
            </thead>
            <!-- <tfoot>
             
            </tfoot> -->
            <tbody>
              

            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
@endsection

@push('js_atas')
<!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }} " rel="stylesheet">
@endpush

@push('js_bawah')

<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }} "></script>
<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }} "></script>

@endpush
