<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LaporanMasukController;
use App\Http\Controllers\LaporanKeluarController;
use App\Http\Controllers\TransaksiMasukController;
use App\Http\Controllers\TransaksiKeluarController;

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

Route::get('/', [AuthController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/listBarang', [BarangController::class, 'index']);
Route::get('/listSupplier', [SupplierController::class, 'index']);
Route::get('/listKategori', [KategoriController::class, 'index']);
Route::get('/listSatuan', [SatuanController::class, 'index']);
Route::get('/inputMasuk', [TransaksiMasukController::class, 'index']);
Route::get('/inputKeluar', [TransaksiKeluarController::class, 'index']);
Route::get('/reportMasuk', [LaporanMasukController::class, 'index']);
Route::get('/reportKeluar', [LaporanKeluarController::class, 'index']);
Route::get('/listUser', [UserController::class, 'index']);

Route::get('/about', function () {
    return view('welcome');
});
