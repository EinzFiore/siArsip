<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

// Route perusahaan
Route::resource('perusahaan', PerusahaanController::class);
Route::post('/perusahaan.import', 'PerusahaanController@importExcel')->name('importPT');
// Route::post('/perusahaan/fetch', 'PerusahaanController@fetch')->name('Perusahaan.fetch');
Route::post('/perusahaan/getPerusahaan/', 'PerusahaanController@getPerusahaan')->name('perusahaan.getPerusahaan');

// Route SerahTerima
Route::resource('serahTerima', SerahTerima::class);
Route::post('serahTerima/exportST', 'SerahTerima@export')->name('exportST');
Route::post('/getDokumen', 'SerahTerima@getDataDokumen')->name('getDokumen');

// Route Batch
Route::resource('batch', BatchController::class);
Route::get('/batch', 'BatchController@index')->name('batch');
Route::post('batch.create', 'BatchController@tambahBatch')->name('tambahBatch');
Route::get('batch/{batch}/export', 'BatchController@exportBatch')->name('batchExport');
Route::get('/batch/export_excel', 'BatchController@export_excel');

// Route JenisDokumen
Route::resource('jenisDokumen', JDController::class);

// Route Rak
Route::resource('rak', RakController::class);
Route::get('rak/{id}/{box}/{batch}/{year}', 'RakController@listDokumen')->name('listDokumen');
Route::get('rak/{rak}/{box}/{year}', 'RakController@showRak');

// Route DataArsip
Route::resource('dataArsip', DataArsipController::class);
Route::post('/dataArsip/getDokumen', 'DataArsipController@getDataSerahTerima')->name('arsip');
Route::post('/dataArsip/getArsip', 'DataArsipController@getDataArsip')->name('getArsip');
Route::post('/arsip/export', 'DataArsipController@exportDataArsip');
Route::post('/arsipStatus/export', 'DataArsipController@exportDataArsipStatus');
Route::post('/arsip/exportPerBulan', 'DataArsipController@exportDataArsipBulanan');
Route::get('/dataArsipImport', 'DataArsipController@listDataImport');
Route::get('/get/arsip/{rak}/{box}/{batch}/{tahun}', 'DataArsipController@findDokumenByRak');
Route::post('/importDataArsip', 'DataArsipController@importData')->name('importData');
Route::post('/getArsipImport', 'DataArsipController@getArsipImport')->name('getArsipImport');
Route::post('/getData', 'DataArsipController@getData')->name('getData');

// Route Peminjaman
Route::resource('peminjaman', PeminjamanController::class);
Route::post('/get/peminjaman', 'PeminjamanController@getDataPeminjaman')->name('getPeminjaman');
Route::post('/get/nd', 'PeminjamanController@getListND')->name('getListND');
Route::get('/get/nd/{nd}', 'PeminjamanController@getDataPeminjamanByND')->name('getByND');
Route::get('/update/peminjaman', 'PeminjamanController@update');

Route::resource('karung', DataKarungController::class);
Route::group(['prefix' => 'karung'], function () {
    Route::post('/get', 'DataKarungController@getDataKarung')->name('getKarung');
    Route::post('/add/data', 'DataKarungController@addDataKarung');
});

Route::get('/users/list', 'DashboardController@userList');

// Jetstream
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/tes', function () {
    return view('Batch/export/batch');
});