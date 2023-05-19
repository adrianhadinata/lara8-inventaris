@extends('layout/main')

@section('container')

<div class="col-xl-12 col-lg-12 col-sm-12">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Barang Masuk</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Supplier</th>
                            <th>Barang</th>
                            <th>Tanggal Masuk</th>
                            <th>Jumlah Barang</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($transaksi_masuks as $transaksi_masuk)
                        <?php $no++ ?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $transaksi_masuk->supplier->nama_supplier }}</td>
                            <td>{{ $transaksi_masuk->barang->nama_barang }}</td>
                            <td>{{ $transaksi_masuk->tanggal_masuk }}</td>
                            <td>{{ $transaksi_masuk->jumlah_barang }}</td>
                            <td>{{ $transaksi_masuk->catatan }}</td>
                            <td>
                                <button type="button" data-target="#modalEditLaporan" data-toggle="modal" class="btn btn-primary buttonEdit">
                                    Edit
                                </button>
                                <form action="masuk/{{ $transaksi_masuk->id }}" method="POST" class="d-inline">
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

<script src="js/laporan/masuk.js" type="text/javascript"></script>

@endsection