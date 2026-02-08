<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory, \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'pendaftaran_pasien';
    protected $fillable = [
        'pasien_id',
        'cabang_id',
        'poli_id',
        'dokter_id',
        'tanggal_kunjungan',
        'nomor_antrian',
        'status'
    ];

    public function pasien()
    {
        return $this->belongsTo(DataPasien::class, 'pasien_id');
    }
}
