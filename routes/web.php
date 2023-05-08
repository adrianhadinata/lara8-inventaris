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
    return view('login');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/listBarang', function () {
    return view('barang/list');
});

Route::get('/listSupplier', function () {
    return view('supplier/list');
});

Route::get('/listKategori', function () {
    return view('kategori/list');
});

Route::get('/listSatuan', function () {
    return view('satuan/list');
});

Route::get('/inputMasuk', function () {
    return view('transaksi/masuk/input');
});

Route::get('/inputKeluar', function () {
    return view('transaksi/keluar/input');
});

Route::get('/reportMasuk', function () {
    return view('laporan/masuk/report');
});

Route::get('/reportKeluar', function () {
    return view('laporan/keluar/report');
});

Route::get('/listUser', function () {
    return view('user/list');
});

Route::get('/about', function () {
    return view('welcome');
});
