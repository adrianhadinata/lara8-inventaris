<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('supplier/list', [
            'lists' => Supplier::all()
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
            'nama_supplier' => 'required|unique:suppliers|min:3|max:255',
            'email' => 'required|unique:suppliers|min:3|max:255|email',
            'telepon' => 'required|min:8|max:255',
            'alamat' => 'required|min:3|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/listSupplier')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ada error di data yang mau kamu buat');
        }

        $validated = $validator->validated();

        Supplier::create($validated);

        return redirect('/listSupplier')->with('success', 'Data baru berhasil ditambahkan');
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
        $supplier = Supplier::find($id);

        $rules = [];

        if ($request->nama_supplier != $supplier->nama_supplier) {
            $rules['nama_supplier'] = 'required|unique:suppliers|min:3|max:255';
        }

        if ($request->email != $supplier->email) {
            $rules['email'] = 'required|unique:suppliers|min:3|max:255|email';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/listSupplier')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ada error di data yang mau kamu edit');
        }

        $validated = $validator->validated();

        Supplier::where('id', $supplier->id)->update($validated);

        return redirect('/listSupplier')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::destroy($id);

        return redirect('/listSupplier')->with('success', 'Data deleted');
    }
}
