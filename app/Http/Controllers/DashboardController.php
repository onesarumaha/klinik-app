<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\DataPasien;
use App\Models\ObatModel;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalUsers = User::count();
        $totalPasien = DataPasien::count();
        $totalObat = ObatModel::count();
        $totalPengunjung = Pendaftaran::count();

        // Data for chart (last 7 days)
        $chartData = Pendaftaran::select(DB::raw('DATE(tanggal_kunjungan) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->take(7)
            ->get();

        $labels = $chartData->pluck('date');
        $totals = $chartData->pluck('total');

        return view('dashboard.admin', compact(
            'totalUsers',
            'totalPasien',
            'totalObat',
            'totalPengunjung',
            'labels',
            'totals'
        ));
    }
}
