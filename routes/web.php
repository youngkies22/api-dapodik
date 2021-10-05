<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\WebService;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/post', function () {
    // $response = Http::get('https://budutwj.id/api/coba', [
    //     'name' => 'Taylor',
    //     'page' => 1,
    // ]);
    // dd($response);
// $data1 = [
//     'data1' => 'value_1',
//     'data2' => 'value_2',
// ];

// $curl = curl_init();

// curl_setopt_array($curl, array(
//     CURLOPT_URL => "https://budutwj.id/api/coba",
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_ENCODING => "",
//     CURLOPT_MAXREDIRS => 10,
//     CURLOPT_TIMEOUT => 30000,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => "POST",
//     CURLOPT_POSTFIELDS => json_encode($data1),
//     CURLOPT_HTTPHEADER => array(
//         // Set here requred headers
//         "accept: */*",
//         "accept-language: en-US,en;q=0.8",
//         "content-type: application/json",
//     ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     print_r(json_decode($response));
// }

    // $cek = Http::post('http://budutwj.id/api/coba', [
    //     'name' => 'Taylor',
    //     'role' => 'Developer',
    // ]);
    // dd($cek);

//     $guzzleClient = new GuzzleHttp\Client([
//     'base_uri' => 'http://budutwj.id/',
//     'verify' => false,
// ]);

// $response = $guzzleClient->post('api/coba', [
//     'query' => [
//         'key1' => 'value1',
//         'key2' => 'value2',
//     ]
// ]);

// $response = json_decode($response->getBody()->getContents(), true);

$response = Http::withOptions([
                'verify' => false,
            ])->post('http://budutwj.id/api/coba', [
                'data' => 'asdw',
                
            ]);
 //$response = json_decode($response->getBody()->getContents(), true);
dd($response->getBody()->getContents());
           

});

Route::get('/home', [WebService::class, 'home'])->name('home');
Route::get('/logout', [WebService::class, 'logOut'])->name('logout');
Route::get('/datasekolah', [WebService::class, 'DataSekolah'])->name('data.sekolah');
Route::get('/datagtk', [WebService::class, 'DataGtk'])->name('data.gtk');
Route::get('/datasiswa', [WebService::class, 'DataSiswa'])->name('data.siswa');




//Route getDataDapodik to Josn File--------------------------------------------------------------------------------
Route::post('/hubungkan-kedapodik', [WebService::class, 'HubungkanKeDapodik'])->name('hubungkan');
Route::get('/koneksi', [WebService::class, 'CekKoneksi'])->name('cek.koneksi');
Route::get('/gtk', [WebService::class, 'getGtk'])->name('get.gtk');
Route::get('/siswa', [WebService::class, 'getSiswa'])->name('get.siswa');
Route::get('/rombel', [WebService::class, 'getRombel'])->name('get.rombel');


