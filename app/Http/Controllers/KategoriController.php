<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori/list');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'nama_kategori' => 'required|unique:kategoris|min:3|max:255'
        ]);
    }
}
