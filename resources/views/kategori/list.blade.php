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
            <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
            <button class="btn btn-info" data-toggle="modal" data-target="#modalTambahKategori">Tambah Kategori +</button>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($lists as $list)
                          <tr>
                            <td class="text-center">
                              <input type="hidden" value="{{ $list->id }}">
                              {{ $list->nama_kategori }}
                            </td>
                            <td class="text-center">
                              <button type="button" data-target="#modalEditKategori" data-toggle="modal" class="btn btn-primary buttonEdit">
                                Edit
                              </button>
                              <form action="kategori/{{ $list->id }}" method="POST" class="d-inline">
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

<!-- Modal Tambah Kategori-->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/kategori" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <label for="nama_kategori">Nama Kategori</label>
                  <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"" name="nama_kategori" value="{{ old('nama_kategori') }}">
                  @error('nama_kategori')
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

<!-- Modal Edit Kategori-->
<div class="modal fade" id="modalEditKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
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
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" value="{{ old('nama_kategori') }}" class="form-control  @error('nama_kategori') is-invalid @enderror" name="nama_kategori" id="nama_kategori">
                @error('nama_kategori')
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
      let inputNama = document.getElementById('nama_kategori');
      let tableRow = e.target.parentElement.parentElement;
      let tableCell = tableRow.childNodes;
      let dataId = tableCell[1].children[0].value;
      let dataNama = tableCell[1].textContent.trim();
      let action = 'kategori/' + dataId;
      formUpdate.action = action;
      inputNama.value = dataNama;
    }
  
    for (var i = 0; i < buttonEdits.length; i++) {
      buttonEdits[i].addEventListener('click', data, false);
    } 
  </script>
  
<script src="js/user/list.js" type="text/javascript"></script>

@endsection