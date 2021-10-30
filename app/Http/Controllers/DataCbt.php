<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/*
function metode
***** CekKoneksi()

*/
class DataCbt extends Controller
{
  public function getMaterData(){
    $params = [
      'title'     => 'DATA SEKOLAH',
      'pesan'     => 'Data GTK di ambil dari file json yang sudah di buat saat melakukan GET Data GTK Dari Dapodik ',
      'titlebar'  => 'DATA GTK DARI DAPODIK',
      'no'        => 1,
     
    ];
    return view('konten/master_data')->with($params);
  }

}

   