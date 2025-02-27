<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' =>'BRG123' ,
                'kategori_nama' => 'Makanan Berat',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' =>'BRG234' ,
                'kategori_nama' => 'Snack',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' =>'BRG345' ,
                'kategori_nama' => 'Minuman Coffee',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' =>'BRG456' ,
                'kategori_nama' => 'Minuman Non-Coffee',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' =>'BRG567' ,
                'kategori_nama' => 'Pastry',
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
