<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


use App\Http\Controllers\GrapfController;
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\TitikController;
use App\Http\Controllers\ButTitikController;
use App\Http\Controllers\JenisHewanController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\InfoController;

Route::get('/grapf', [GrapfController::class, 'showShortestPath']);

Route::get('/ttrgf', function () {
    return view('graff');
});
Route::get('/find-route', [GrapfController::class, 'findShortestRoute']);

Route::get('/calculate-distance', function(){
    return view('calculate_distance');
});
Route::post('/calculate-distance/store', [DistanceController::class, 'store']);
Route::get('/', function(){
    return view('index');
});
Route::get('/new', [TitikController::class,'index']);
Route::get('/teser', [ButTitikController::class,'GetTitikBut']);
Route::get('/ButTitik', [ButTitikController::class,'index']);

Route::post('/titik/store', [TitikController::class,'store']);
Route::post('/ButTitik/store', [ButTitikController::class,'store']);
Route::get('/titik/hitung', [TitikController::class, 'hitungJarak']);
Route::get('/go', [TitikController::class, 'go']);
// Route::get('/ceksql', [TitikController::class, 'teslagi']);
Route::get('/setTempat',function(){
    return view('set');
});
Route::get('/jenis',function(){
    return view('tambahJenis');
});
Route::post('/Jenis/store', [JenisHewanController::class, 'store']);
Route::get('/hewan',[HewanController::class,'index']);
Route::post('/Hewan/store', [HewanController::class, 'store']);
// Route::post('');
Route::get('/setinfo/{siapa}',[InfoController::class,'index']);
Route::post('/setinfo/store/{siapa}',[InfoController::class,'store']);
Route::get('/apeni',[InfoController::class,'cek']);
Route::post('/closest-Route',[InfoController::class,'Rute']);
Route::post('/closest-Route2',[InfoController::class,'RuteHamilton']);
Route::get('/denah',[InfoController::class,'final']);
Route::get('/denah2',[InfoController::class,'final2']);
// Route::get('/rute',[InfoController::class,'rute']);






