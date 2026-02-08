<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DataPasien;
use App\Models\RekamMedisObat;

class RekamMedis extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rekam_medis';
    protected $fillable = [
        'pendaftaran_id',
        'pasien_id',
        'dokter_id',
        'keluhan',
        'diagnosis',
        'catatan',
        'tekanan_darah',
        'suhu',
        'berat_badan',
        'tinggi_badan'
    ];

    public function pasien()
    {
        return $this->belongsTo(DataPasien::class, 'pasien_id');
    }

    public function obats()
    {
        return $this->hasMany(RekamMedisObat::class, 'rekam_medis_id');
    }
}
