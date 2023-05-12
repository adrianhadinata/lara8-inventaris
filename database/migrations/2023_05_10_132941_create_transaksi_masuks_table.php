<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->foreignId('supplier_id');
            $table->foreignId('barang_id');
            $table->string('tanggal_masuk');
            $table->string('jumlah_barang');
            $table->string('catatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_masuks');
    }
}
