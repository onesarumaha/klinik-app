<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'no_rekam_medis',
        'nik',
        'nama',
        'jk',
        'tgl_lahir',
        'hp',
        'alamat',
        'gol_darah'
    ];
}
