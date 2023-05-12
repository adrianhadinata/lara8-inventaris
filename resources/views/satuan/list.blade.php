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
            <h6 class="m-0 font-weight-bold text-primary">Data Satuan</h6>
            <button class="btn btn-info" data-toggle="modal" data-target="#modalTambahSatuan">Tambah Satuan +</button>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Satuan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lists as $list)
                          <tr>
                            <td class="text-center">
                              <input type="hidden" value="{{ $list->id }}">
                              {{ $list->nama_satuan }}
                            </td>
                            <td class="text-center">
                              <button type="button" data-target="#modalEditSatuan" data-toggle="modal" class="btn btn-primary buttonEdit">
                                Edit
                              </button>
                              <form action="satuan/{{ $list->id }}" method="POST" class="d-inline">
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

<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modalTambahSatuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Satuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/satuan" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <label for="nama_satuan">Nama Satuan</label>
                  <input type="text" value="{{ old('nama_satuan') }}" class="form-control  @error('nama_satuan') is-invalid @enderror" name="nama_satuan">
                  @error('nama_satuan')
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
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modalEditSatuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Satuan</h5>
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
                <label for="nama_satuan">Nama Satuan</label>
                <input type="text" value="{{ old('nama_satuan') }}" class="form-control  @error('nama_satuan') is-invalid @enderror" name="nama_satuan" id="nama_satuan">
                @error('nama_satuan')
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
</div>

<script>
  let buttonEdits = document.getElementsByClassName("buttonEdit");

  function data(e){
    let formUpdate = document.getElementById('updateData');
    let inputNama = document.getElementById('nama_satuan');
    let tableRow = e.target.parentElement.parentElement;
    let tableCell = tableRow.childNodes;
    let dataId = tableCell[1].children[0].value;
    let dataNama = tableCell[1].textContent.trim();
    let action = 'satuan/' + dataId;
    formUpdate.action = action;
    inputNama.value = dataNama;
  }

  for (var i = 0; i < buttonEdits.length; i++) {
    buttonEdits[i].addEventListener('click', data, false);
  } 
</script>
<script src="js/satuan/list.js" type="text/javascript"></script>

@endsection