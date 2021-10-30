<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\WebService;
use App\Http\Controllers\SendData;
use App\Http\Controllers\DataCbt;
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



Route::get('/', function () {
    return view('welcome');
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


//Route get data master candy redis CBT--------------------------------------------------------------
Route::get('/master-data', [DataCbt::class, 'getMaterData'])->name('get.master.data');


//send data ke applikasi yang kita sesuikan

Route::get('/post', [SendData::class, 'SendDataToApp'])->name('send.data.post');


