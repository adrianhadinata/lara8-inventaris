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
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
            <button class="btn btn-info" data-toggle="modal" data-target="#modalTambahUser">Tambah User +</button>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach ($lists as $list)
                          <tr>
                            <td class="text-center">
                              <input type="hidden" value="{{ $list->id }}">
                              {{  }}
                            </td>
                            <td class="text-center">
                              {{ $list->email }}
                            </td>
                            <td class="text-center">
                              {{ $list->name }}
                            </td>
                            <td class="text-center">
                              {{ $list->username }}
                            </td>
                            <td class="text-center">
                              {{ $list->role }}
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

<!-- Modal Tambah User-->
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/user/tambah" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <label for="namaUser">Nama User</label>
                  <input type="text" class="form-control" name="namaUser">
              </div>
              <div class="col-12">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username">
              </div>
              <div class="col-12">
                  <label for="password">Password</label>
                  <input type="text" class="form-control" name="password">
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

<script src="js/user/list.js" type="text/javascript"></script>

@endsection