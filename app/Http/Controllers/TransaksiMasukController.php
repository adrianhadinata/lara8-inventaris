<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Transaksi_masuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaksi/masuk/input', [
            'barangs' => Barang::all(),
            'suppliers' => Supplier::all()
        ]);
    }

    public function transIn()
    {
        return view('laporan/masuk/report', [
            'barangs' => Barang::all(),
            'suppliers' => Supplier::all(),
            'transaksi_masuks' => Transaksi_masuk::all()
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
            'kode_transaksi' => 'required|unique:transaksi_masuks|min:3|max:255',
            'supplier_id' => 'required',
            'barang_id' => 'required',
            'tanggal_masuk' => 'required',
            'jumlah_barang' => 'required|numeric|min:1',
            'catatan' => 'required|min:3|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/inputMasuk')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ada error di data yang mau kamu buat');
        }

        $validated = $validator->validated();

        Transaksi_masuk::create($validated);

        return redirect('/inputMasuk')->with('success', 'Data baru berhasil ditambahkan');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
