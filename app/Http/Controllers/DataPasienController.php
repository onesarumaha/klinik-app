<?php

namespace App\Http\Controllers;

use App\Models\DataPasien;
use Illuminate\Http\Request;

class DataPasienController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pasien = DataPasien::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('no_rekam_medis', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->paginate(5);

        return view('data_pasien.index', compact('pasien'));
    }

    public function create()
    {
        return view('data_pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_rekam_medis' => 'required|unique:data_pasien,no_rekam_medis',
            'nik' => 'required|unique:data_pasien,nik',
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'required',
        ]);

        DataPasien::create($request->all());

        return redirect()->route('data_pasien.index')->with('success', 'Data pasien berhasil ditambahkan!');
    }

    public function show(DataPasien $data_pasien)
    {
        return view('data_pasien.show', compact('data_pasien'));
    }

    public function edit(DataPasien $data_pasien)
    {
        return view('data_pasien.edit', compact('data_pasien'));
    }

    public function update(Request $request, DataPasien $data_pasien)
    {
        $request->validate([
            'no_rekam_medis' => 'required|unique:data_pasien,no_rekam_medis,' . $data_pasien->id,
            'nik' => 'required|unique:data_pasien,nik,' . $data_pasien->id,
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
        ]);

        $data_pasien->update($request->all());

        return redirect()->route('data_pasien.index')->with('success', 'Data pasien berhasil diupdate!');
    }

    public function destroy(DataPasien $data_pasien)
    {
        $data_pasien->delete();
        return redirect()->route('data_pasien.index')->with('success', 'Data pasien berhasil dihapus!');
    }
}
