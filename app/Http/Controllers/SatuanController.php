<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('satuan/list', [
            'lists' => Satuan::all()
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
        $rules = [];
        $rules['nama_satuan'] = 'required|unique:satuans|min:3|max:255';
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/listSatuan')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ada error di data yang mau kamu buat');
        }

        $validated = $validator->validated();

        Satuan::create($validated);

        return redirect('/listSatuan')->with('success', 'Data baru berhasil ditambahkan');
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
        $satuan = Satuan::find($id);

        $rules = [];

        if ($request->nama_satuan != $satuan->nama_satuan) {
            $rules['nama_satuan'] = 'required|unique:satuans|min:3|max:255';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/listSatuan')
                ->withErrors($validator)
                ->with('error', 'Ada error di data yang mau kamu edit');
        }

        $validated = $validator->validated();

        Satuan::where('id', $satuan->id)->update($validated);

        return redirect('/listSatuan')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Satuan::destroy($id);

        return redirect('/listSatuan')->with('success', 'Data berhasil dihapus');
    }
}
