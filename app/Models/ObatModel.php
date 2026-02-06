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
}
