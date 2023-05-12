<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('barang/list', [
            'kategoris' => Kategori::all(),
            'satuans' => Satuan::all(),
            'barangs' => Barang::all()
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
            'stok' => 'required|numeric',
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
            'stok' => 'required|numeric',
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
