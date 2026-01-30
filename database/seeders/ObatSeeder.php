<?php

namespace Database\Seeders;

use App\Models\ObatModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 1000; $i++) {
            ObatModel::create([
                'kode' => 'AA- ' . $i,
                'nama' => 'Obat ' . $i,
                'kategori' => 'kategori ' . $i,
                'satuan' => 'satuan ' . $i,
                'stok'      => rand(1, 100),
                'harga'     => rand(5000, 50000),
            ]);
        }
    }
}
