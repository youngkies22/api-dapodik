<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/*
function metode
***** CekKoneksi()

*/
class WebService extends Controller
{
    public function __construct()
    {
      //parameter pada dapodik
       $this->getSekolah = 'getSekolah';
       $this->getRombonganBelajar = 'getRombonganBelajar';
       $this->getPengguna = 'getPengguna';
       $this->getPesertaDidik = 'getPesertaDidik';
       $this->getGtk = 'getGtk';
    }

    //menu sidebar -------------------------------------------------------------------------
    public function home()
    {
      //hitung jumlah data -------------------------------------------------------
        if (file_exists(base_path('/json/getGtk.json'))) { $jsonString = file_get_contents(base_path('/json/getGtk.json')); $dataGtk = json_decode($jsonString); }
        else{ $dataGtk=[]; }
        if (file_exists(base_path('/json/getSiswa.json'))) { $jsonString = file_get_contents(base_path('/json/getSiswa.json')); $dataSiswa = json_decode($jsonString); }
        else{ $dataSiswa=[]; }
        if (file_exists(base_path('/json/getRombel.json'))) { $jsonString = file_get_contents(base_path('/json/getRombel.json')); $dataRombel = json_decode($jsonString); }
        else{ $dataRombel=[]; }
        

      //hitung jumlah data -------------------------------------------------------
      
      $jsonString = $this->CekKoneksi();
      $dataArray = $jsonString->getData();

      $params = [
        'data_sekolah'  => 1,
        'data_gtk'      => count($dataGtk),
        'data_siswa'    => count($dataSiswa),
        'data_rombel'   => count($dataRombel),
        'data_koneksi'  => $dataArray, 
      ];

 
      if($dataArray->status == 'OK'){
        return view('konten/home')->with($params);
      }
      elseif ($dataArray->status == 'LOL') {
        return view('koneksi')->with($params);
      }
      else{
        dd($dataArray->status);
      }
      
      
    }
    
    public function DataGtk()
    {
      if (file_exists(base_path('/json/getGtk.json'))) {
        $jsonString = file_get_contents(base_path('/json/getGtk.json'));
        $dataVariabel = json_decode($jsonString);
      }
      else{
        $dataVariabel=null;
      } 
      $params = [
        'title'     => 'DATA SEKOLAH',
        'pesan'     => 'Data GTK di ambil dari file json yang sudah di buat saat melakukan GET Data GTK Dari Dapodik ',
        'titlebar'  => 'DATA GTK DARI DAPODIK',
        'no'        => 1,
        'data_gtk'  => $dataVariabel,
      ];
      return view('konten/data_gtk')->with($params);
    }

    public function DataSiswa()
    {
      if (file_exists(base_path('/json/getSiswa.json'))) {
        $jsonString = file_get_contents(base_path('/json/getSiswa.json'));
        $dataVariabel = json_decode($jsonString);
      }
      else{
        $dataVariabel=null;
      } 
      $params = [
        'title'     => 'DATA SISWA',
        'pesan'     => 'Data SISWA di ambil dari file json yang sudah di buat saat melakukan GET Data SISWA Dari Dapodik ',
        'titlebar'  => 'DATA SISWA DARI DAPODIK',
        'no'        => 1,
        'data'      => $dataVariabel,
      ];
      return view('konten/data_siswa')->with($params);
    }

    public function DataSekolah()
    {
      if (file_exists(base_path('/json/getSekolah.json'))) {
        $jsonString = file_get_contents(base_path('/json/getSekolah.json'));
        $dataVariabel = json_decode($jsonString);
      }
      else{
        $dataVariabel=null; 
      }
      $params = [
        'title'         => 'DATA SEKOLAH',
        'pesan'         => 'Data Sekolah di ambil dari file json yang sudah di buat saat melakukan GET Data Sekolah Dari Dapodik',
        'titlebar'      => 'DATA SEKOLAH DARI DAPODIK',
        'no'            => 1,
        'data_sekolah'  => $dataVariabel,
      ];
      return view('konten/data_sekolah')->with($params);
    }
    
    //menu sidebar -------------------------------------------------------------------------

//function untuk membantu ----------------------------------------------------------------------------------
    function getVariabel($npsn=null,$token=null){
      //function yang pertama kali di cek 
      //cek file variabel lokasi NPSN dan TOKEN
        if (file_exists(base_path('/json/variabel.json'))) {
            $jsonString = file_get_contents(base_path('/json/variabel.json'));
            $dataVariabel = json_decode($jsonString);
        } else {
          //write json to file --------------------------------------------------
            $arrayVariabel = array(
              'npsn'  => (empty($npsn)) ? '1234567' : $npsn,  //'MASUKAN NPSNYA'
              'token' => (empty($token)) ? 'asdwqwerty' : $token,  //MASUKAN TOKEN WEBSERVICE DARI DAPODIK'
            );

            $fp = fopen(base_path('/json/variabel.json'), 'w');
            fwrite($fp, json_encode($arrayVariabel, JSON_PRETTY_PRINT));
            fclose($fp);

          //write json to file --------------------------------------------------
        }
        if(!isset($dataVariabel)){
          return view('koneksi');
        }
        else{
          return $dataVariabel;
        }
        
    }

    function getUrl($url){
      //method url untuk webservice dapodik
        $token = $this->getVariabel()->token;
        $npsn = $this->getVariabel()->npsn;
        $parameter = $url;

        $response = Http::withToken($token)->get('http://localhost:5774/WebService/'.$parameter,['npsn' => $npsn,]);
        $array = json_decode($response);
        return $array;

    }
    function getStatusKoneksi(){
      $jsonString = $this->CekKoneksi();
      $dataArray = $jsonString->getData();
      return $dataArray;
    }

// Handel Koneksi ke Dapodik-------------------------------------------------------------------------------------------------

    public function HubungkanKeDapodik(Request $request)
    {
        //proses menghubungkan ke web service api dapodik
        //atau bisa di bilang proses login ^_^
        
        //write json to file --------------------------------------------------
            $arrayVariabel = array(
              'npsn'  => $request->npsn,  //'MASUKAN NPSNYA'
              'token' => $request->token,  //MASUKAN TOKEN WEBSERVICE DARI DAPODIK'
            );

            $fp = fopen(base_path('/json/variabel.json'), 'w');
            fwrite($fp, json_encode($arrayVariabel, JSON_PRETTY_PRINT));
            fclose($fp);

          //write json to file --------------------------------------------------  
        return redirect('/home');
    }
    public function logOut(){
      //write json to file --------------------------------------------------
            $arrayVariabel = array(
              'npsn'  => 'NPSN',  //'MASUKAN NPSNYA'
              'token' => 'TOKEN',  //MASUKAN TOKEN WEBSERVICE DARI DAPODIK'
            );

            $fp = fopen(base_path('/json/variabel.json'), 'w');
            fwrite($fp, json_encode($arrayVariabel, JSON_PRETTY_PRINT));
            fclose($fp);

          //write json to file --------------------------------------------------  
        return redirect('/home');
    }


    public function CekKoneksi(){
      //cek koneksi ke dapodik
        $dataDapodik = $this->getUrl($this->getSekolah);
        if(empty($dataDapodik)){
          $response = [
                'status'   =>'LOL',
                'success'  =>'Koneksi Tidak Tersedia',
                'pesan'     =>'Sekolah Tidak Di Temukan',
                'catatan'  =>'Cek Kembali NPSN dan TOKEN <br> Pastikan Masukan dengan Baik dan Benar'
              ];
              return response()->json($response,405);
        }
        else{
          if(isset($dataDapodik->success) == 'false'){
            //jika koneksi tidak terhubung
            $response = [
                'status'   =>'LOL',
                'success'  =>'Koneksi Tidak Tersedia',
                'pesan'    =>$dataDapodik->message,
                'catatan'  =>'Cek Kembali NPSN dan TOKEN <br> Pastikan Masukan dengan Baik dan Benar'
              ];
              return response()->json($response,405);
          }
          else{
            //jika koneksi terhubung 
            $array2 = $dataDapodik->rows;
            if(!empty($array2->npsn)){
              $response = [
                'status'  =>'OK',
                'success' =>'Koneksi Tersedia',
                'nama'    => $array2->nama,
                'npsn'    => $array2->nama,
              ];
              
              //write json to file --------------------------------------------------
                $fp = fopen(base_path('/json/getSekolah.json'), 'w');
                fwrite($fp, json_encode($array2, JSON_PRETTY_PRINT));
                fclose($fp);
              //write json to file ----------------------------------------------
              
              return response()->json($response,200);
            }
            else{
              $response = [
                'status'  =>'ERROR',
                'error'=>'Koneksi Tidak Tersedia'
              ];
              return response()->json($response,500);
            }
          }
        }
      
    } //end CekKoneksi()

//method get data dapodik ke file json ---------------------------------------------------------------------
    public function getRombel(){
      //get data Rombongan Belajar dari dapodik
        
        $dataArray = $this->getStatusKoneksi();

        if($dataArray->status == 'LOL'){
          $response = [
            'success' =>'Cek Koneksi Dapodik',
          ];
          return response()->json($response,403);
        }
        else{
          $dataDapodik = $this->getUrl($this->getRombonganBelajar);
          //dd($dataDapodik);
          $array = $dataDapodik->rows;
          foreach ($array as $val) {
            $data[] =array(
              'rombel_id'     => $val->rombongan_belajar_id,
              'nama'          => $val->nama,
              'level_rombel'  => $val->tingkat_pendidikan_id,
              'jurusan_id'    => $val->jurusan_id,
              'jurusan'       => $val->jurusan_id_str,
            );
          }

          //write json to file --------------------------------------------------
              $fp = fopen(base_path('/json/getRombel.json'), 'w');
              fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
              fclose($fp);

          //write json to file --------------------------------------------------
          $response = [
            'success' =>'File Json Sudah Tersedia',
          ];
          return response()->json($response,200);

        }


    }


    public function getGtk(){
      //get data GTK dari dapodik

        //cek koneksi dapodiknya
        $dataArray = $this->getStatusKoneksi();

        if($dataArray->status == 'LOL'){
          $response = [
            'success' =>'Cek Koneksi Dapodik',
          ];
          return response()->json($response,403);
        }
        else{
          $dataDapodik = $this->getUrl($this->getGtk);
          $array = $dataDapodik->rows;
          //dd($array);

          foreach ($array as $val) {
            $data[] =array(
              'nama_gtk'            => strtoupper($val->nama),
              'nip'                 => $val->nip,
              'jsk'                 => $val->jenis_kelamin,
              'nuptk'               => $val->nuptk,
              'nik'                 => $val->nik,
              'tempat_lahir'        => $val->tempat_lahir,
              'tanggal_lahir'       => $val->tanggal_lahir,
              'agama'               => strtoupper($val->agama_id_str),
              'pendidikan_terakhir' => $val->pendidikan_terakhir,
              'jenis_ptk_id_str'    => $val->jenis_ptk_id_str,
            );
          }
          //write json to file --------------------------------------------------
              $fp = fopen(base_path('/json/getGtk.json'), 'w');
              fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
              fclose($fp);

          //write json to file --------------------------------------------------
          $response = [
            'success' =>'File Json Sudah Tersedia',
          ];
          return response()->json($response,200);
        }
        


    } //end getGtk

    public function getSiswa(){
      //get data siswa dari dapodik
        //cek koneksi dapodiknya
        $dataArray = $this->getStatusKoneksi();

        if($dataArray->status == 'LOL'){
          $response = [
            'success' =>'Cek Koneksi Dapodik',
          ];
          return response()->json($response,403);
        }
        else{

          $dataDapodik = $this->getUrl($this->getPesertaDidik);
          //dd($dataDapodik);
          
          //array dari data siswa
          $array = $dataDapodik->rows;
          //dd($array);

          //looping data siswa
          //looping di sini untuk memilih beberapa 
          //data recode siswa yang di butuhkan saja
          //untuk di gunakan
          //bisa di sesuaikan dengan kebutuhan
          //tinggal ubah pada data array  
          foreach ($array as $val) {
            $data[] =array(
              'nama_siswa'    => strtoupper($val->nama),
              'nis'           => $val->nipd,
              'jsk'           => $val->jenis_kelamin,
              'nisn'          => $val->nisn,
              'nik'           => $val->nik,
              'tempat_lahir'  => $val->tempat_lahir,
              'tanggal_lahir' => $val->tanggal_lahir,
              'agama'         => strtoupper($val->agama_id_str),
              'hp_siswa'      => $val->nomor_telepon_seluler,
              'ibu'           => strtoupper($val->nama_ibu),
              'ayah'          => strtoupper($val->nama_ayah),
              'kode_rombel'   => $val->rombongan_belajar_id,
              'nama_rombel'   => $val->nama_rombel,
            );
          }
          //write json to file --------------------------------------------------
              $fp = fopen(base_path('/json/getSiswa.json'), 'w');
              fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
              fclose($fp);

          //write json to file --------------------------------------------------
          $response = [
            'success' =>'File Json Sudah Tersedia',
          ];
          return response()->json($response,200);
        }
        
        

    }//end getSiswa()

    

}

/*Catatan Parameter yang di ambil dari dapodik untuk di ubah sesuai kebutuhan ----------------------------------------*/

/*
  parameter tidak terkoneksi degan dapodik
 +"success": false
  +"http_code": 403
  +"status_code": "Forbidden"
  +"message": "Aplikasi tidak terdaftar pada Web Service Dapodik"

*/

  /*
      parameter yang ada getSekolah
       +"sekolah_id": "abcdefghijklmnopqrstuvwxyz"
        +"nama": "SMKS BUDI UTOMO 1 WAY JEPARA"
        +"nss": "123456789"
        +"npsn": "12345678"
        +"bentuk_pendidikan_id": 15
        +"bentuk_pendidikan_id_str": "SMK"
        +"status_sekolah": "2"
        +"status_sekolah_str": "Swasta"
        +"alamat_jalan": "JL. PISANG NO. 163"
        +"rt": "4"
        +"rw": "2"
        +"kode_wilayah": "120708AD"
        +"kode_pos": "34196"
        +"nomor_telepon": "123456789"
        +"nomor_fax": null
        +"email": "email@gmail.com"
        +"website": "www.sekolah.sch.id"
        +"is_sks": false
        +"lintang": "-5.179922134"
        +"bujur": "105.7059045672"
        +"dusun": "Catur Sakti"
        +"desa_kelurahan": "Braja Sakti"
        +"kecamatan": "Kec. Way Jepara"
        +"kabupaten_kota": "Kab. Lampung Timur"
        +"provinsi": "Prov. Lampung"
      */


 /*
  parameter peserta didik
  +"registrasi_id": "7a687a91-a39b-46b8-bfd7-c8eabc9e89c0"
    +"jenis_pendaftaran_id": "1"
    +"jenis_pendaftaran_id_str": "Siswa baru"
    +"nipd": "5441"
    +"tanggal_masuk_sekolah": "2021-07-12"
    +"sekolah_asal": "SMP NEGERI 2 KERTOSONO"
    +"peserta_didik_id": "cc35fe04-cc06-e211-ab66-01832d67b705"
    +"nama": "NOVAL ARIYANTO"
    +"nisn": "0054838549"
    +"jenis_kelamin": "L"
    +"nik": "3518100511050002"
    +"tempat_lahir": "LAMPUNG TIMUR"
    +"tanggal_lahir": "2005-11-05"
    +"agama_id": 1
    +"agama_id_str": "Islam"
    +"alamat_jalan": "Jln. P. Diponegoro, Kertosono"
    +"nomor_telepon_rumah": "0"
    +"nomor_telepon_seluler": "082111639040"
    +"nama_ayah": "Aditya Eka Prasetya N"
    +"pekerjaan_ayah_id": 6
    +"pekerjaan_ayah_id_str": "Karyawan Swasta"
    +"nama_ibu": "NONI WAHYUNI"
    +"pekerjaan_ibu_id": 1
    +"pekerjaan_ibu_id_str": "Tidak bekerja"
    +"nama_wali": null
    +"pekerjaan_wali_id": 0
    +"pekerjaan_wali_id_str": ""
    +"tinggi_badan": "154"
    +"berat_badan": "40"
    +"semester_id": "20211"
    +"email": null
    +"anggota_rombel_id": "ef991c93-1d50-4211-a35f-d46e536e4ff8"
    +"rombongan_belajar_id": "9e0b7784-b772-42fb-a00d-a1ca166df16f"
    +"tingkat_pendidikan_id": "10"
    +"nama_rombel": "X TB"
    +"kurikulum_id": 471
    +"kurikulum_id_str": "SMK 2013 REV.  Tata Busana"
 */

  /*
    parameter gtk
     +"tahun_ajaran_id": "2021"
    +"ptk_terdaftar_id": "825a8d38-7dc4-4b42-9165-6121514b7312"
    +"ptk_id": "135999fc-807a-40b9-a86e-dad21ec28eda"
    +"ptk_induk": "1"
    +"tanggal_surat_tugas": "2020-07-01"
    +"nama": "A. Margianto"
    +"jenis_kelamin": "L"
    +"tempat_lahir": "Sribhawono,"
    +"tanggal_lahir": "1982-05-30"
    +"agama_id": 2
    +"agama_id_str": "Kristen"
    +"nuptk": "2862760662200002"
    +"nik": "1807073005820001"
    +"jenis_ptk_id": "20"
    +"jenis_ptk_id_str": "Kepala Sekolah"
    +"status_kepegawaian_id": 4
    +"status_kepegawaian_id_str": "GTY/PTY"
    +"nip": null
    +"pendidikan_terakhir": "S1"
    +"bidang_studi_terakhir": "Pendidikan Jasmani dan Kesehatan"
    +"pangkat_golongan_terakhir": "-"
    +"rwy_pend_formal": array:1 [▶]
    +"rwy_kepangkatan": []
  }
  */

  /*
    parameter rombongan belajar
      0 => {#308 ▼
      +"rombongan_belajar_id": "9e0b7784-b772-42fb-a00d-a1ca166df16f"
      +"nama": "X TB"
      +"tingkat_pendidikan_id": "10"
      +"semester_id": "20211"
      +"jenis_rombel": "1"
      +"kurikulum_id": 471
      +"kurikulum_id_str": "SMK 2013 REV.  Tata Busana"
      +"id_ruang": "98b97a9a-4ecf-4018-8a12-802647ba2311"
      +"id_ruang_str": "Ruang Teori/Kelas 3"
      +"moving_class": "Tidak"
      +"ptk_id": "90ddf45d-a153-461f-9228-91dfa944b7f9"
      +"ptk_id_str": "Miftahul Jannah"
      +"jenis_rombel_str": "Kelas"
      +"jurusan_id": "40100805"
      +"jurusan_id_str": "Tata Busana"
      +"anggota_rombel": array:38 [▶]
      +"pembelajaran": array:17 [▶]
  */
