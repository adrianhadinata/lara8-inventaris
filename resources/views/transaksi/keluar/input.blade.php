@extends('layout/main')

@section('container')

<div class="col-xl-6 col-md-6 col-sm-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Transaksi Barang Keluar
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800" style="display:inline-flex">
                        BLABLABLA
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-12 col-lg-12 col-sm-12">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi Barang Keluar</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="/barang/keluar/tambah" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label for="kodeTransaksi">Kode Transaksi</label>
                        <input type="text" name="kodeTransaksi" id="kodeTransaksi" class="form-control" readonly>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="namaPenerima">Nama Penerima</label>
                        <input type="text" placeholder="Masukan penerima..." name="namaPenerima" id="namaPenerima" class="form-control">
                    </div>
                    <div class="col-8 mt-2">
                        <label for="namaBarang">Nama Barang</label>
                        <select name="namaBarang" id="namaBarang" class="form-control">
                            <option value="">Pilih barang</option>
                        </select>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="tanggalKeluar">Tanggal Keluar</label>
                        <input type="date" name="tanggalKeluar" id="tanggalKeluar" class="form-control">
                    </div>
                    <div class="col-4 mt-2">
                        <label for="jumlahBarang">Jumlah Barang</label>
                        <input type="text" placeholder="Masukan jumlah..." name="jumlahBarang" id="jumlahBarang" class="form-control">
                    </div>
                    <div class="col-4 mt-2">
                        <label for="stokBarang">Stok Barang</label>
                        <input type="text" name="stokBarang" id="stokBarang" class="form-control" readonly>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="totalBarang">Total Barang</label>
                        <input type="text" name="totalBarang" id="totalBarang" class="form-control" readonly>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="catatanKeluar">Catatan</label>
                        <textarea class="form-control" placeholder="Masukan catatan..." name="catatanKeluar" id="catatanKeluar" id="catatanKeluar" rows="3"></textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary" style="display: block;width: 100%;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection