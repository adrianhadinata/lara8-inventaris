<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori/list', [
            'lists' => Kategori::all()
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_kategori' => 'required|unique:kategoris|min:3|max:255'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/listKategori')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ada error di data yang mau kamu buat');
        }

        $validated = $validator->validated();

        Kategori::create($validated);

        return redirect('/listKategori')->with('success', 'Data baru berhasil ditambahkan');
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
        $kategori = Kategori::find($id);

        $rules = [];

        if ($request->nama_kategori != $kategori->nama_kategori) {
            $rules['nama_kategori'] = 'required|unique:kategoris|min:3|max:255';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/listKategori')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ada error di data yang mau kamu edit');
        }

        $validated = $validator->validated();

        Kategori::where('id', $kategori->id)->update($validated);

        return redirect('/listKategori')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kategori::destroy($id);

        return redirect('/listKategori')->with('success', 'Data deleted');
    }
}
