@extends('layout/main')

@section('container')

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
                    <tbody></tbody>
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
        <form action="/supplier/tambah" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="namaSupplier">Nama Supplier</label>
                        <input type="text" class="form-control" name="namaSupplier">
                    </div>
                    <div class="col-12">
                        <label for="emailSupplier">Email Supplier</label>
                        <input type="text" class="form-control" name="emailSupplier">
                    </div>
                    <div class="col-12">
                        <label for="teleponSupplier">Telepon Supplier</label>
                        <input type="text" class="form-control" name="teleponSupplier">
                    </div>
                    <div class="col-12">
                        <label for="lokasiSupplier">Alamat Supplier</label>
                        <input type="text" class="form-control" name="lokasiSupplier">
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

<script src="js/supplier/list.js" type="text/javascript"></script>

@endsection