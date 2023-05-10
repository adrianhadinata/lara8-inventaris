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

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/listBarang', [BarangController::class, 'index'])->middleware('auth');
Route::get('/listSupplier', [SupplierController::class, 'index'])->middleware('auth');
Route::get('/listKategori', [KategoriController::class, 'index'])->middleware('auth');
Route::get('/listSatuan', [SatuanController::class, 'index'])->middleware('auth');
Route::get('/inputMasuk', [TransaksiMasukController::class, 'index'])->middleware('auth');
Route::get('/inputKeluar', [TransaksiKeluarController::class, 'index'])->middleware('auth');
Route::get('/reportMasuk', [LaporanMasukController::class, 'index'])->middleware('auth');
Route::get('/reportKeluar', [LaporanKeluarController::class, 'index'])->middleware('auth');
Route::get('/listUser', [UserController::class, 'index'])->middleware('auth');

Route::get('/about', function () {
    return view('welcome');
});
