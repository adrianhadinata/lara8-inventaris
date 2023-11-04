<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangInStock = DB::select("SELECT
            barangs.id,
            barangs.nama_barang,
            barangs.merk,
            satuans.nama_satuan,
            kategoris.nama_kategori,
            barangs.kategori_id,
            barangs.satuan_id,
            barangs.lokasi,
            (
	            IFNULL( SUM( transaksi_masuks.jumlah_barang ), 0 ) - IFNULL( SUM( transaksi_keluars.jumlah_barang ), 0 )) stok  
        FROM
            barangs
            LEFT JOIN satuans ON barangs.satuan_id = satuans.id
            LEFT JOIN kategoris ON barangs.kategori_id = kategoris.id
            LEFT JOIN transaksi_masuks ON barangs.id = transaksi_masuks.barang_id
            LEFT JOIN transaksi_keluars ON barangs.id = transaksi_keluars.barang_id 
        GROUP BY
            barangs.id");
 
        return view('barang/list', [
            'kategoris' => Kategori::all(),
            'satuans' => Satuan::all(),
            'barangs' => $barangInStock
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_barang' => 'required|unique:barangs|min:3|max:255',
            'kategori_id' => 'required',
            'merk' => 'required|min:3|max:255',
            'satuan_id' => 'required',
            'lokasi' => 'required|min:3|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/listBarang')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ada error di data yang mau kamu buat');
        }

        $validated = $validator->validated();

        Barang::create($validated);

        return redirect('/listBarang')->with('success', 'Data baru berhasil ditambahkan');

        // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        $rules = [
            'kategori_id' => 'required',
            'merk' => 'required|min:3|max:255',
            'satuan_id' => 'required',
            'lokasi' => 'required|min:3|max:255'
        ];

        if ($request->nama_barang != $barang->nama_barang) {
            $rules['nama_barang'] = 'required|unique:barangs|min:3|max:255';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/listBarang')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ada error di data yang mau kamu edit');
        }

        $validated = $validator->validated();

        Barang::where('id', $barang->id)->update($validated);

        return redirect('/listBarang')->with('success', 'Data berhasil diupdate');
    }

    public function getById()
    {
        $id = $_GET['id'];
        $barang = Barang::find($id);

        return response()->json($barang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Barang::destroy($id);

        return redirect('/listBarang')->with('success', 'Data berhasil dihapus');
    }
}
