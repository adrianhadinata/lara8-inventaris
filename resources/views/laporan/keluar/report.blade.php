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


<div class="col-xl-12 col-lg-12 col-sm-12">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Barang Keluar</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Penerima</th>
                            <th>Barang</th>
                            <th>Tanggal Keluar</th>
                            <th>Jumlah Barang</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                            @foreach($transaksi_keluars as $transaksi_keluar)
                            <?php $no++ ?>
                            <tr>
                                <td>
                                    <input type="hidden" value="{{ $transaksi_keluar->id }}">
                                    <input type="hidden" value="{{ $transaksi_keluar->kode_transaksi }}">
                                    <input type="hidden" value="{{ $transaksi_keluar->barang->stok }}">
                                    {{ $no }}
                                </td>
                                <td>{{ $transaksi_keluar->nama_penerima }}</td>
                                <td>{{ $transaksi_keluar->barang->nama_barang }}</td>
                                <td>{{ $transaksi_keluar->tanggal_keluar }}</td>
                                <td>{{ $transaksi_keluar->jumlah_barang }}</td>
                                <td>{{ $transaksi_keluar->catatan }}</td>
                                <td>
                                    <button type="button" data-target="#modalEditLaporan" data-toggle="modal" class="btn btn-primary buttonEdit">
                                        Edit
                                    </button>
                                    <form action="barang/keluar/{{ $transaksi_keluar->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return confirm('kamu yakin?')" class="btn btn-danger">
                                        Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Laporan-->
<div class="modal fade" id="modalEditLaporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="updateData">
            @method('put')
            @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="kode_transaksi">Kode Transaksi</label>
                            <input type="text" id="kode_transaksi" name="kode_transaksi" class="form-control" readonly>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="nama_penerima">Nama Supplier</label>
                            <input type="text" id="nama_penerima" name="nama_penerima" class="form-control">
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
                            <select id="stokBarang" class="form-control" disabled>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let buttonEdits = document.getElementsByClassName("buttonEdit");
    document.getElementById('barang_id').onchange = function(){
        document.getElementById('stokBarang').value = document.getElementById('barang_id').value
        document.getElementById('totalBarang').value = parseInt(document.getElementById('stokBarang').options[document.getElementById('stokBarang').selectedIndex].text) + parseInt(document.getElementById('jumlah_barang').value)
    };

    document.getElementById('jumlah_barang').onkeyup = function(){
        document.getElementById('totalBarang').value = parseInt(document.getElementById('stokBarang').options[document.getElementById('stokBarang').selectedIndex].text) + parseInt(document.getElementById('jumlah_barang').value)
    };
  
    function data(e){
      let formUpdate = document.getElementById('updateData');
      let inputKodeTransaksi = document.getElementById('kode_transaksi');
      let inputTanggalKeluar = document.getElementById('tanggal_keluar');
      let inputNamaPenerima = document.getElementById('nama_penerima');
      let inputBarang = document.getElementById('barang_id');
      let inputStokBarang = document.getElementById('stokBarang');
      let inputTotalBarang = document.getElementById('totalBarang');
      let inputJumlah = document.getElementById('jumlah_barang');
      let inputCatatan = document.getElementById('catatan');

      let tableRow = e.target.parentElement.parentElement;
      let tableCell = tableRow.childNodes;

      let dataId = tableCell[1].children[0].value;
      let dataKodeTransaksi = tableCell[1].children[1].value;
      let dataStokBarang = tableCell[1].children[2].value;
      let dataNamaPenerima = tableCell[3].textContent.trim();
      let dataBarang = tableCell[5].textContent.trim();
      let dataTanggalKeluar = tableCell[7].textContent.trim();
      let dataJumlah = tableCell[9].textContent.trim();
      let dataCatatan = tableCell[11].textContent.trim();
      let action = 'barang/keluar/' + dataId;
      
      formUpdate.action = action;
      inputNamaPenerima.value = dataNamaPenerima
      inputKodeTransaksi.value = dataKodeTransaksi;
      inputTanggalKeluar.value = dataTanggalKeluar;
      inputJumlah.value = dataJumlah;
      inputCatatan.value = dataCatatan;

      for (var i=0; i<inputBarang.options.length; i++) {
          option = inputBarang.options[i];
          if (option.text == dataBarang) {
              option.setAttribute('selected', true);
          } else {
              option.removeAttribute('selected');
          }
      }      

      for (var i=0; i<inputStokBarang.options.length; i++) {
          option = inputStokBarang.options[i];
          if (option.text == dataStokBarang) {
              option.setAttribute('selected', true);
          } else {
              option.removeAttribute('selected');
          }
      }      

      inputTotalBarang.value = parseInt(inputJumlah.value) + parseInt(inputStokBarang.options[inputStokBarang.selectedIndex].text);
    }
    
    for (var i = 0; i < buttonEdits.length; i++) {
      buttonEdits[i].addEventListener('click', data, false);
    } 

  </script>

<script src="js/laporan/keluar.js" type="text/javascript"></script>

@endsection