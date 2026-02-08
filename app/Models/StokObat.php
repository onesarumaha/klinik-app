<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokObat extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory, \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'stok_obat';
    protected $fillable = [
        'obat_id',
        'cabang_id',
        'qty_sebelum',
        'qty',
        'qty_sesudah',
        'type',
        'tgl_kadarluarsa'
    ];

    public function obat()
    {
        return $this->belongsTo(ObatModel::class, 'obat_id');
    }
}
