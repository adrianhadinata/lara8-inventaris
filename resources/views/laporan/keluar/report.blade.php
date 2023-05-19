@extends('layout/main')

@section('container')

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
                                <td>{{ $no }}</td>
                                <td>{{ $transaksi_keluar->nama_penerima }}</td>
                                <td>{{ $transaksi_keluar->barang->nama_barang }}</td>
                                <td>{{ $transaksi_keluar->tanggal_keluar }}</td>
                                <td>{{ $transaksi_keluar->jumlah_barang }}</td>
                                <td>{{ $transaksi_keluar->catatan }}</td>
                                <td>
                                    <button type="button" data-target="#modalEditLaporan" data-toggle="modal" class="btn btn-primary buttonEdit">
                                        Edit
                                    </button>
                                    <form action="keluar/{{ $transaksi_keluar->id }}" method="POST" class="d-inline">
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

<script src="js/laporan/keluar.js" type="text/javascript"></script>

@endsection