<?php

namespace App\Http\Controllers;

use App\Models\ObatModel;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ObatModel::orderBy('id', 'desc')->get();
        return view('data_obat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:data_obat,kode',
            'nama' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'nullable|integer',
        ]);

        ObatModel::create($request->all());

        return redirect()->route('data-obat')->with('success', 'Data obat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $obat = ObatModel::findOrFail($id);
        return view('data_obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $obat = ObatModel::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:data_obat,kode,' . $id,
            'nama' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'nullable|integer',
        ]);

        $obat->update($request->all());

        return redirect()->route('data-obat')->with('success', 'Data obat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = ObatModel::findOrFail($id);
        $obat->delete();

        return redirect()->route('data-obat')->with('success', 'Data obat berhasil dihapus!');
    }
}
