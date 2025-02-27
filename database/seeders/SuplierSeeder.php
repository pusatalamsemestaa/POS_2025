<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SuplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'suplier_id' => 1,
                'suplier_kode' =>'SPR123' ,
                'suplier_nama' => 'PT Susu Freshmilk',
            ],
            [
                'suplier_id' => 2,
                'suplier_kode' =>'SPR234' ,
                'suplier_nama' => 'PT Syrup Drip ',
            ],
            [
                'suplier_id' => 3,
                'suplier_kode' =>'SPR345' ,
                'suplier_nama' => 'PT Royal Bakery',
            ],
        ];
        DB::table('m_suplier')->insert($data);
    }
}
