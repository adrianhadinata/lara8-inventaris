@extends('layout/main')

@section('container')

<div class="row">
    <div class="col-xl-12 col-md-12 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl font-weight-bold text-success text-uppercase mb-1">
                            Selamat Datang, {{auth()->user()->name}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-3 col-sm-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Barang Masuk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-3 col-sm-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Barang Keluar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-3 col-sm-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Barang</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-3 col-sm-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Supplier</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6 col-sm-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Scan Code Barang</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div id="reader"></div>
            </div>
        </div>
    </div>

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6 col-sm-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Hasil Scan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <label>Nama Barang:</label>
                        <p id="penampungNama"></p>
                    </div>
                    <div class="col-12">
                        <label>Stok Barang:</label>
                        <p id="penampungStok"></p>
                    </div>
                    <div class="col-12">
                        <label>Lokasi Barang:</label>
                        <p id="penampungLokasi"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/html5-qrcode.min.js" type="text/javascript"></script>
<script>
    let namaBarang = document.getElementById('penampungNama');
    let stokBarang = document.getElementById('penampungStok');
    let lokasiBrang = document.getElementById('penampungLokasi');

    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        id_barang = decodedText
        
        $.ajax({
            url: 'getOneBarang/{id}',
            type: "GET",
            data: {
                id: id_barang
            },
            dataType: "json",
            success: (data) => {
                namaBarang.innerHTML = '<strong>' + data.nama_barang + '</strong>';
                stokBarang.innerHTML = '<strong>' + data.stok + '</strong>';
                lokasiBrang.innerHTML = '<strong>' + data.lokasi + '</strong>';
            }
        })
    }

    var html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
</script>

@endsection