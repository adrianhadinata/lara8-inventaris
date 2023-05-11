@extends('layout/main')

@section('container')

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
                    <tbody></tbody>
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
        <form action="/kategori/tambah" method="POST">
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

@if(count($errors) > 0)
  <script>
    var myModal = new bootstrap.Modal(document.getElementById('modalTambahKategori'));
    myModal.show();
  </script>
@endif

<script src="js/user/list.js" type="text/javascript"></script>

@endsection