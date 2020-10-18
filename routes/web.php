<?php

use Illuminate\Support\Facades\Route;
use App\Models\Perusahaan;

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
Route::get('/api/perusahaan', function () {
});

// Route SerahTerima
Route::resource('serahTerima', SerahTerima::class);
Route::get('/serahTerima', 'SerahTerima@index');
Route::post('/serahTerima.createProses', 'SerahTerima@createProses')->name('serahTerimaProses');
Route::post('/serahTerima/tmpData', 'SerahTerima@tmpData')->name('tmpData');

// Route Batch
Route::resource('batch', BatchController::class);
Route::get('/batch', 'BatchController@index')->name('batch');
Route::post('batch.create', 'BatchController@tambahBatch')->name('tambahBatch');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/routes', function () {
    $routeCollection = Route::getRoutes();
    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Name</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" . $value->uri() . "</td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
});
