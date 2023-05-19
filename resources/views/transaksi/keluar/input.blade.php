@extends('layout/main')

@section('container')

@if(session()->has('success'))
<div class="col-xl-12 col-lg-12 col-sm-12">
  <div class="alert alert-success" role="alert">
    {{session('success')}}
  </div>
</div>
@endif

@if(session()->has('error'))
<div class="col-xl-12 col-lg-12 col-sm-12">
  <div class="alert alert-danger" role="alert">
    {{session('error')}}
  </div>
</div>
@endif

<div class="col-xl-6 col-md-6 col-sm-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Transaksi Barang Keluar
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800" style="display:inline-flex" id="divNoTransaksi">
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
            <form action="/barang/keluar" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label for="kode_transaksi">Kode Transaksi</label>
                        <input type="text" id="kode_transaksi" name="kode_transaksi" class="form-control" readonly>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="nama_penerima">Nama Penerima</label>
                        <input type="text" name="nama_penerima" id="nama_penerima" class="form-control  @error('nama_penerima') is-invalid @enderror" value="{{ old('nama_penerima')}}" placeholder="Nama penerima...">
                        @error('nama_penerima')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-8 mt-2">
                        <label for="barang_id">Nama Barang</label>
                        <select name="barang_id" id="barang_id" class="form-control @error('barang_id') is-invalid @enderror">
                            <option value="">Pilih barang</option>
                            @foreach ($barangs as $barang)
                                @if ( old('barang_id') == $barang->id)
                                    <option value="{{ $barang->id }}" selected>{{ $barang->nama_barang }}</option>
                                @else 
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('barang_id')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-4 mt-2">
                        <label for="tanggal_keluar">Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror" value="{{ old('tanggal_keluar') }}"">
                        @error('tanggal_keluar')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-4 mt-2">
                        <label for="jumlah_barang">Jumlah Barang</label>
                        <input type="number" value="{{ old('jumlah_barang') ? old('jumlah_barang') : 0 }}" name="jumlah_barang" id="jumlah_barang" placeholder="Masukan jumlah..." class="form-control @error('jumlah_barang') is-invalid @enderror">
                        @error('jumlah_barang')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-4 mt-2">
                        <label for="stokBarang">Stok Barang</label>
                        <select id="stokBarang" class="form-control">
                            <option value="">0</option>
                            @foreach ($barangs as $barang)
                                @if ( old('barang_id') == $barang->id)
                                    <option value="{{ $barang->id }}" selected>{{ $barang->stok }}</option>
                                @else 
                                    <option value="{{ $barang->id }}">{{ $barang->stok }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="totalBarang">Total Barang</label>
                        <input type="text" value="0" id="totalBarang" class="form-control" readonly>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" id="catatan" placeholder="Masukan catatan..." rows="3"">
                            {{ old('catatan') }}
                        </textarea>
                        @error('catatan')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary" style="display: block;width: 100%;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const date = new Date(), noTransaksi = 'TRANSOUT' + date.getDate() + date.getMonth() + date.getFullYear() + date.getHours() + date.getMinutes();
    
    document.getElementById('kode_transaksi').value = noTransaksi;
    document.getElementById('divNoTransaksi').innerHTML = noTransaksi;
    document.getElementById('totalBarang').value = parseInt(document.getElementById('stokBarang').options[document.getElementById('stokBarang').selectedIndex].text) - parseInt(document.getElementById('jumlah_barang').value)
    
    document.getElementById('barang_id').onchange = function(){
        document.getElementById('stokBarang').value = document.getElementById('barang_id').value
        document.getElementById('totalBarang').value = parseInt(document.getElementById('stokBarang').options[document.getElementById('stokBarang').selectedIndex].text) - parseInt(document.getElementById('jumlah_barang').value)
    };
    
    document.getElementById('jumlah_barang').onkeyup = function(){
        document.getElementById('totalBarang').value = parseInt(document.getElementById('stokBarang').options[document.getElementById('stokBarang').selectedIndex].text) - parseInt(document.getElementById('jumlah_barang').value)
    };
    </script>

@endsection