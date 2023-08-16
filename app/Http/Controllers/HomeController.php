<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Transaksi_keluar;
use App\Models\Transaksi_masuk;

class HomeController extends Controller
{
    public function index()
    {

        return view('home', [
            'jumlahBarang' => count(Barang::all()),
            'jumlahSupplier' => count(Supplier::all()),
            'jumlahTransaksiKeluar' => count(Transaksi_keluar::all()),
            'jumlahTransaksiMasuk' => count(Transaksi_masuk::all()),
        ]);
    }
}
