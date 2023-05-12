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

<div class="col-xl-12 col-lg-12 col-sm-12">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Supplier</h6>
            <button class="btn btn-info" data-toggle="modal" data-target="#modalTambahSupplier">Tambah Supplier +</button>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Supplier</th>
                            <th>Email Supplier</th>
                            <th>Telepon Supplier</th>
                            <th>Alamat Supplier</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lists as $list)
                          <tr>
                            <td class="text-center">
                              <input type="hidden" value="{{ $list->id }}">
                              {{ $list->nama_supplier }}
                            </td>
                            <td class="text-center">
                              {{ $list->email }}
                            </td>
                            <td class="text-center">
                              {{ $list->telepon }}
                            </td>
                            <td class="text-center">
                              {{ $list->alamat }}
                            </td>
                            <td class="text-center">
                              <button type="button" data-target="#modalEditSupplier" data-toggle="modal" class="btn btn-primary buttonEdit">
                                Edit
                              </button>
                              <form action="supplier/{{ $list->id }}" method="POST" class="d-inline">
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

<!-- Modal Tambah Supplier-->
<div class="modal fade" id="modalTambahSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/supplier" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror" name="nama_supplier" value="{{ old('nama_supplier') }}">
                        @error('nama_supplier')
                            <div        class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="email">Email Supplier</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div        class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="telepon">Telepon Supplier</label>
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" value="{{ old('telepon') }}">
                        @error('telepon')
                            <div        class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="alamat">Alamat Supplier</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}">
                        @error('alamat')
                            <div        class="invalid-feedback">
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

<!-- Modal Edit Supplier-->
<div class="modal fade" id="modalEditSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
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
                    <label for="nama_supplier">Nama Supplier</label>
                    <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror" name="nama_supplier" value="{{ old('nama_supplier') }}" id="nama_supplier">
                    @error('nama_supplier')
                        <div        class="invalid-feedback">
                        {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="email">Email Supplier</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email">
                    @error('email')
                        <div        class="invalid-feedback">
                        {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="telepon">Telepon Supplier</label>
                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" value="{{ old('telepon') }}" id="telepon">
                    @error('telepon')
                        <div        class="invalid-feedback">
                        {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="alamat">Alamat Supplier</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}"
                    id="alamat">
                    @error('alamat')
                        <div        class="invalid-feedback">
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
        let inputNama = document.getElementById('nama_supplier');
        let inputEmail = document.getElementById('email');
        let inputTelepon = document.getElementById('telepon');
        let inputAlamat = document.getElementById('alamat');
        let tableRow = e.target.parentElement.parentElement;
        let tableCell = tableRow.childNodes;
        let dataId = tableCell[1].children[0].value;
        let dataNama = tableCell[1].textContent.trim();
        let dataEmail = tableCell[3].textContent.trim();
        let dataTelepon = tableCell[5].textContent.trim();
        let dataAlamat = tableCell[7].textContent.trim();
        let action = 'supplier/' + dataId;
        formUpdate.action = action;
        inputNama.value = dataNama;
        inputEmail.value = dataEmail;
        inputTelepon.value = dataTelepon;
        inputAlamat.value = dataAlamat;
        
      }
    
      for (var i = 0; i < buttonEdits.length; i++) {
        buttonEdits[i].addEventListener('click', data, false);
      } 
    </script>

<script src="js/supplier/list.js" type="text/javascript"></script>

@endsection