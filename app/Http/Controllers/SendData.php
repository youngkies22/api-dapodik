<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/*
function metode
***** CekKoneksi()

*/
class SendData extends Controller
{
    public function __construct()
    {
      //parameter pada dapodik
       $this->getSekolah = 'getSekolah';
  
    }
    public function SendDataToApp(){
      ini_set('max_execution_time', 180);
      /*
        metode yang di gunakan sederhana 
        hanya memanfaatkan metode get untuk proses
        agar token bisa di sesuikan dengan kebutuhan secara
        sederhana, sehingga memudahkan dalam memodifikasinya kembali
      */
      if (file_exists(base_path('/json/getSiswa.json'))) {
        $jsonString = file_get_contents(base_path('/json/getSiswa.json'));
        $base64 = base64_encode($jsonString);
        
      }
      else{
        $dataVariabel=null;
      } 
      // if($dataVariabel == null){ dd('asd'); }
      // else{
        // $no=1;
        // foreach($dataVariabel as $val){
        //   $no++;
        //   if($no == 100){
        //     $no=1;
        //     $data_array[] = $val;
           
            
        //   }
          


        // }

          //$url = 'http://localhost:8000/api/getpost';
      
            // $response = Http::withOptions(['verify' => false, ])->get('http://localhost:8000/api/getpost', [
            //               'token' => '$2y$10$oec23i.hXwCp2sSHwzn1DOP6mo0OXYcFH5UtDkFfRQJlnx83v.cei',
            //               'data'  => $base64,
            //             ]);
            // //$response = json_decode($response->getBody()->getContents(), true);
            // return $response;
            

            $urlApi = 'http://localhost:8000/api/getpost?toke=$2y$10$oec23i.hXwCp2sSHwzn1DOP6mo0OXYcFH5UtDkFfRQJlnx83v.cei';
            $headers = [
              'Content-Type: application/json', 
              
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlApi);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonString);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            //dd($urlApi);
            //dd($jsonString);
            dd($response);
        
     // }
     
  
  
    }
}

   