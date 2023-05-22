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

<div class="col-xl-3 col-md-3 col-sm-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Barang
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
            <button class="btn btn-info" data-toggle="modal" data-target="#modalTambahBarang">Tambah Barang +</button>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode QR</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Merek</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangs as $barang)
                            <tr>
                                <td class="text-center">
                                    <img id='barcode' src="https://api.qrserver.com/v1/create-qr-code/?data={{ $barang->id }}&amp;size=150x150" alt="" title="{{ $barang->nama_barang }}" width="100" height="100" />
                                </td>
                                <td>
                                    <input type="hidden" value="{{ $barang->id }}">
                                    {{ $barang->nama_barang }}
                                </td>
                                <td>{{ $barang->kategori->nama_kategori }}</td>
                                <td>{{ $barang->merk }}</td>
                                <td>{{ $barang->stok }}</td>
                                <td>{{ $barang->satuan->nama_satuan }}</td>
                                <td>{{ $barang->lokasi }}</td>
                                <td>
                                    <button type="button" data-target="#modalEditBarang" data-toggle="modal" class="btn btn-primary buttonEdit">
                                        Edit
                                    </button>
                                    <form action="barang/{{ $barang->id }}" method="POST" class="d-inline">
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

<!-- Modal Tambah Barang-->
<div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/barang" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang') }}">
                        @error('nama_barang')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                  </div>
                  <div class="col-6">
                        <label for="kategori_id" >Kategori Barang</label>
                        <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id" >
                            @foreach ($kategoris as $kategori)
                                @if ( old('kategori_id') == $kategori->id)
                                    <option value="{{ $kategori->id }}" selected>{{ $kategori->nama_kategori }}</option>
                                @else 
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                  </div>
                  <div class="col-6">
                        <label for="merk"> Merek Barang</label>
                        <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ old('merk') }}">
                        @error('merk')
                            <div        class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                  </div>
                  <div class="col-12">
                        <label for="stok">Jumlah Barang</label>
                        <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok') }}">
                        @error('stok')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                  </div>
                  <div class="col-12">
                        <label for="satuan_id">Satuan Barang</label>
                        <select name="satuan_id" class="form-control @error('satuan_id') is-invalid @enderror" id="">
                        @foreach ($satuans as $satuan)
                            @if (old('satuan_id') == $satuan->id)
                                <option value="{{ $satuan->id }} selected">{{ $satuan->nama_satuan }}</option>
                            @else 
                                <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                            @endif
                        @endforeach
                        </select>
                        @error('satuan_id')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                  </div>
                  <div class="col-12">
                        <label for="lokasi">Lokasi Barang</label>
                        <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ old('lokasi') }}"">
                        @error('lokasi')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
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

<!-- Modal Edit Barang-->
<div class="modal fade" id="modalEditBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
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
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang') }}" id="nama_barang">
                        @error('nama_barang')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                </div>
                <div class="col-6">
                        <label for="kategori_id" >Kategori Barang</label>
                        <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id" id="kategori_id">
                            @foreach ($kategoris as $kategori)
                                @if ( old('kategori_id') == $kategori->id)
                                    <option value="{{ $kategori->id }}" selected>{{ $kategori->nama_kategori }}</option>
                                @else 
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                </div>
                <div class="col-6">
                    <label for="merk"> Merek Barang</label>
                    <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ old('merk') }}" id="merk">
                    @error('merk')
                        <div        class="invalid-feedback">
                          {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="stok">Jumlah Barang</label>
                    <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok') }}" id="stok">
                    @error('stok')
                        <div class="invalid-feedback">
                          {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="satuan_id">Satuan Barang</label>
                    <select name="satuan_id" class="form-control @error('satuan_id') is-invalid @enderror" id="satuan_id">
                    @foreach ($satuans as $satuan)
                        @if (old('satuan_id') == $satuan->id)
                            <option value="{{ $satuan->id }} selected">{{ $satuan->nama_satuan }}</option>
                        @else 
                            <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                        @endif
                    @endforeach
                    </select>
                    @error('satuan_id')
                        <div class="invalid-feedback">
                          {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="lokasi">Lokasi Barang</label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ old('lokasi') }}" id="lokasi">
                    @error('lokasi')
                        <div class="invalid-feedback">
                          {{$message}}
                        </div>
                    @enderror
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
    
      function data(e){
        let formUpdate = document.getElementById('updateData');
        let inputNama = document.getElementById('nama_barang');
        let inputKategori = document.getElementById('kategori_id');
        let inputMerk = document.getElementById('merk');
        let inputJumlah = document.getElementById('stok');
        let inputSatuan = document.getElementById('satuan_id');
        let inputLokasi = document.getElementById('lokasi');
        let tableRow = e.target.parentElement.parentElement;
        let tableCell = tableRow.childNodes;
        let dataId = tableCell[1].children[0].value;
        let dataNama = tableCell[1].textContent.trim();
        let dataKategori = tableCell[3].textContent.trim();
        let dataMerk = tableCell[5].textContent.trim();
        let dataJumlah = tableCell[7].textContent.trim();
        let dataSatuan = tableCell[9].textContent.trim();
        let dataLokasi = tableCell[11].textContent.trim();
        let action = 'barang/' + dataId;
        
        formUpdate.action = action;
        inputNama.value = dataNama;
        inputMerk.value = dataMerk;
        inputJumlah.value = dataJumlah;
        inputLokasi.value = dataLokasi;

        for (var i=0; i<inputSatuan.options.length; i++) {
            option = inputSatuan.options[i];
            console.log(option)
            if (option.text == dataSatuan) {
                option.setAttribute('selected', true);
            } else {
                option.removeAttribute('selected');
            }
        }

        for (var i=0; i<inputKategori.options.length; i++) {
            option = inputKategori.options[i];
            if (option.text == dataKategori) {
                option.setAttribute('selected', true);
            } else {
                option.removeAttribute('selected');
            }
        }      
      }
      
      for (var i = 0; i < buttonEdits.length; i++) {
        buttonEdits[i].addEventListener('click', data, false);
      } 

    </script>

<script src="js/barang/list.js" type="text/javascript"></script>

@endsection