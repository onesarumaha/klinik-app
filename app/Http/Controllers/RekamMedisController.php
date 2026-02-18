<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\RekamMedisObat;
use App\Models\ObatModel;
use App\Models\StokObat;
use App\Models\DataPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    public function index()
    {
        $data = RekamMedis::with('pasien')->orderBy('id', 'desc')->get();
        return view('rekam_medis.index', compact('data'));
    }

    public function create()
    {
        $pasien = DataPasien::all();
        $obat = ObatModel::where('stok', '>', 0)->get();
        return view('rekam_medis.create', compact('pasien', 'obat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:data_pasien,id',
            'keluhan' => 'required',
            'diagnosis' => 'required',
            'obats' => 'required|array',
            'obats.*.obat_id' => 'required|exists:data_obat,id',
            'obats.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $rekam_medis = RekamMedis::create([
                'pasien_id' => $request->pasien_id,
                'keluhan' => $request->keluhan,
                'diagnosis' => $request->diagnosis,
                'catatan' => $request->catatan ?? '',
                'tekanan_darah' => $request->tekanan_darah,
                'suhu' => $request->suhu,
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
            ]);

            foreach ($request->obats as $item) {
                $obat = ObatModel::findOrFail($item['obat_id']);

                if ($obat->stok < $item['jumlah']) {
                    throw new \Exception("Stok obat {$obat->nama} tidak mencukupi!");
                }

                $qty_sebelum = $obat->stok;
                $qty_keluar = $item['jumlah'];
                $qty_sesudah = $qty_sebelum - $qty_keluar;

                // Update stok master
                $obat->stok = $qty_sesudah;
                $obat->save();

                // Log history stok
                StokObat::create([
                    'obat_id' => $obat->id,
                    'cabang_id' => 1, // Default cabang
                    'qty_sebelum' => $qty_sebelum,
                    'qty' => $qty_keluar,
                    'qty_sesudah' => $qty_sesudah,
                    'type' => 'keluar',
                ]);

                // Simpan item rekam medis
                RekamMedisObat::create([
                    'rekam_medis_id' => $rekam_medis->id,
                    'obat_id' => $obat->id,
                    'jumlah' => $qty_keluar,
                    'dosis' => $item['dosis'] ?? '-',
                ]);
            }

            DB::commit();
            return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis dan stok obat berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $rekam_medis = RekamMedis::with(['pasien', 'obats.obat'])->findOrFail($id);
        return view('rekam_medis.show', compact('rekam_medis'));
    }
}
