<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

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
        $credentials = $request->validate([
            'nama_kategori' => 'required|unique:kategoris|min:3|max:255'
        ]);

        Kategori::create($credentials);

        return redirect('/listKategori')->with('success', 'New data has been created');
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
            $rules['nama_satuan'] = 'required|unique:satuans|min:3|max:255';
        }

        $validatedData = $request->validate($rules);

        Kategori::where('id', $kategori->id)->update($validatedData);

        return redirect('/listKategori')->with('success', 'Data updated');
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

        return redirect('/listKategori')->with('success', 'Data deleted');
    }
}
