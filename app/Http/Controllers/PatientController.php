<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->q) {
            $query->where('nama', 'like', '%' . $request->q . '%')
                ->orWhere('nik', 'like', '%' . $request->q . '%')
                ->orWhere('no_rekam_medis', 'like', '%' . $request->q . '%');
        }

        $patients = $query->paginate(5)->withQueryString();

        return view('patients.index', compact('patients'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_rekam_medis' => 'required|unique:patients,no_rekam_medis',
            'nik'            => 'required|unique:patients,nik',
            'nama'           => 'required|string|max:255',
            'jk'             => 'required|in:L,P',
            'tgl_lahir'      => 'required|date',
            'hp'             => 'nullable|string|max:20',
            'alamat'         => 'nullable|string',
            'gol_darah'      => 'nullable|in:A,B,AB,O',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')
            ->with('success', 'Patient created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'no_rekam_medis' => 'required|unique:data_pasien,no_rekam_medis,' . $patient->id,
            'nik'            => 'required|unique:data_pasien,nik,' . $patient->id,
            'nama'           => 'required|string|max:255',
            'jk'             => 'required|in:L,P',
            'tgl_lahir'      => 'required|date',
            'hp'             => 'nullable|string|max:20',
            'alamat'         => 'nullable|string',
            'gol_darah'      => 'nullable|in:A,B,AB,O',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'Patient deleted successfully.');
    }
}
