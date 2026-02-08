<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObatModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_obat';
    protected $fillable = ['kode', 'nama', 'kategori', 'satuan', 'harga', 'stok'];

    public function stokHistory()
    {
        return $this->hasMany(StokObat::class, 'obat_id');
    }

    public function rekamMedisItems()
    {
        return $this->hasMany(RekamMedisObat::class, 'obat_id');
    }
}
