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

  function ambilJurusan($id=null){
    if (file_exists(base_path('/json/getRombel.json'))) {
      $jsonString = file_get_contents(base_path('/json/getRombel.json'));
      $dataVariabel = json_decode($jsonString);
    }
    else{
      $dataVariabel=null;
    }
    
    foreach($dataVariabel as $val){
        if($val->rombel_id == $id){ 
          return $val;
        }
    }
    
  }


  function prosesMaterData(){
      $nama_server = 'SR01';
      if (file_exists(base_path('/json/getSiswa.json'))) {
        $jsonString = file_get_contents(base_path('/json/getSiswa.json'));
        $dataVariabel = json_decode($jsonString);
      }
      else{
        $dataVariabel=null;
      }

      if(!empty($dataVariabel)){
        function split_name($name) {
            //function split nama depan nama tengah nama belakang
            $parts = array();

            while ( strlen( trim($name)) > 0 ) {
                $name = trim($name);
                $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                $parts[] = $string;
                $name = trim( preg_replace('#'.preg_quote($string,'#').'#', '', $name ) );
            }

            if (empty($parts)) {
                return false;
            }

            $parts = array_reverse($parts);
            $name = array();
            $name['first_name'] = $parts[0];
            $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
            $name['last_name'] = (isset($parts[2])) ? $parts[2] : ( isset($parts[1]) ? $parts[1] : '');
            
            //return $name;
           
            $hitungNama = strlen($name['first_name']);
            if($hitungNama > 2){ return $name['first_name']; }
            else{ return $name['first_name'].' '.$name['middle_name']; }
            
        }
        function AcakRandom()   
        {   
          $text = 'abcdefghijklmnopqrstuvwxyz123457890';
          $panj = 7;
          $txtl = strlen($text)-1;
          $result = '';
          for($i=1; $i<=$panj; $i++){
           $result .= $text[rand(0, $txtl)];
          }
          
          return $result;   
        }   



        //$arrayFilter =array();
        foreach ($dataVariabel as $key => $val) {
          $jrs = $this->ambilJurusan($val->kode_jurusan);
          
          $data[] =array(
              'nama_siswa'    => strtoupper($val->nama_siswa),
              'nis'           => $val->nis,
              'jsk'           => $val->jsk,
              'nisn'          => $val->nisn,
              //'nik'           => $val->nik,
              //'tempat_lahir'  => $val->tempat_lahir,
              //'tanggal_lahir' => $val->tanggal_lahir,
              'agama'         => strtoupper($val->agama),
              //'hp_siswa'      => $val->hp_siswa,
              'kode_rombel'   => $val->kode_rombel,
              'nama_rombel'   => $val->nama_rombel,
              'kode_kelas'    => $val->kelas,
              'kode_jurusan'  => $jrs->jurusan_id,
              'nama_jurusan'  => $jrs->jurusan,
              'paket'         => 'A',
              'nama_depan'    => strtoupper(split_name($val->nama_siswa)),
              'server'        => $nama_server,
              'sesi'          => 1,
              'ruang'         => 'R1',
              'username'      => AcakRandom(),
              'password'      => AcakRandom(),

            );
        }
        dd($data);
      }
  }

}






/*
// -------------------------------------------------------------------------------
 function split_name2($name) {
  //function split nama depan dan nama belakang
    $name = trim($name);
    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
    return array($first_name, $last_name);
}
function split_name($name) {
    //function split nama depan nama tengah nama belakang
    $parts = array();

    while ( strlen( trim($name)) > 0 ) {
        $name = trim($name);
        $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $parts[] = $string;
        $name = trim( preg_replace('#'.preg_quote($string,'#').'#', '', $name ) );
    }

    if (empty($parts)) {
        return false;
    }

    $parts = array_reverse($parts);
    $name = array();
    $name['first_name'] = $parts[0];
    $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
    $name['last_name'] = (isset($parts[2])) ? $parts[2] : ( isset($parts[1]) ? $parts[1] : '');
    
    //return $name;
   
    $hitungNama = strlen($name['first_name']);
    if($hitungNama > 2){ return $name['first_name']; }
    else{ return $name['first_name'].' '.$name['middle_name']; }
    
}
$arrayFilter =array();
foreach ($array as $key => $value) {
  if($value->tingkat_pendidikan_id == 12){
    $arrayFilter[] = split_name($value->nama);
  }

}
dd($arrayFilter);
// -------------------------------------------------------------------------------
*/
  /*
  0 => {#658 ▼
    +"rombel_id": "9e0b7784-b772-42fb-a00d-a1ca166df16f"
    +"nama": "X TB"
    +"level_rombel": "10"
    +"jurusan_id": "40100805"
    +"jurusan": "Tata Busana"
  }

  */