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
Route::post('/perusahaan.import', 'PerusahaanController@importExcel');
// Route::post('/perusahaan/fetch', 'PerusahaanController@fetch')->name('Perusahaan.fetch');
Route::post('/perusahaan/getPerusahaan/','PerusahaanController@getPerusahaan')->name('perusahaan.getPerusahaan');

// Route SerahTerima
Route::resource('serahTerima', SerahTerima::class);
Route::get('/serahTerima', 'SerahTerima@index');
Route::post('/serahTerima.createProses', 'SerahTerima@createProses')->name('serahTerimaProses');
Route::post('/serahTerima/tmpData', 'SerahTerima@tmpData')->name('tmpData');

// Route Batch
Route::get('/batch', 'BatchController@index');
Route::post('batch.create', 'BatchController@tambahBatch');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
