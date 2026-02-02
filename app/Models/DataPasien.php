<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPasien extends Model
{
    use HasFactory;

    protected $table = 'data_pasien';

    protected $fillable = [
        'no_rekam_medis',
        'nik',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'gol_darah',
    ];
}
