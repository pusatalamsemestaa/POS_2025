<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1000,
                'user_id' => 3,
                'pembeli' => 'Angga',
                'penjualan_kode'=>'26FEB01',
                'penjualan_tanggal' => '2025-02-26 09:30:00',
            ],
            [
                'penjualan_id' => 2000,
                'user_id' => 3,
                'pembeli' => 'Ricky',
                'penjualan_kode'=>'26FEB02',
                'penjualan_tanggal' => '2025-02-26 09:45:00',
            ],
            [
                'penjualan_id' => 3000,
                'user_id' => 3,
                'pembeli' => 'Luqman',
                'penjualan_kode'=>'26FEB03',
                'penjualan_tanggal' => '2025-02-26 10:12:00',
            ],
            [
                'penjualan_id' => 4000,
                'user_id' => 3,
                'pembeli' => 'Gita',
                'penjualan_kode'=>'26FEB04',
                'penjualan_tanggal' => '2025-02-26 10:47:00',
            ],
            [
                'penjualan_id' => 5000,
                'user_id' => 3,
                'pembeli' => 'Icca',
                'penjualan_kode'=>'26FEB05',
                'penjualan_tanggal' => '2025-02-26 11:23:00',
            ],
            [
                'penjualan_id' => 6000,
                'user_id' => 3,
                'pembeli' => 'Bella',
                'penjualan_kode'=>'26FEB06',
                'penjualan_tanggal' => '2025-02-26 12:34:00',
            ],
            [
                'penjualan_id' => 7000,
                'user_id' => 3,
                'pembeli' => 'Rully',
                'penjualan_kode'=>'26FEB07',
                'penjualan_tanggal' => '2025-02-26 12:56:00',
            ],
            [
                'penjualan_id' => 8000,
                'user_id' => 3,
                'pembeli' => 'Yani',
                'penjualan_kode'=>'26FEB08',
                'penjualan_tanggal' => '2025-02-26 13:12:00',
            ],
            [
                'penjualan_id' => 9000,
                'user_id' => 3,
                'pembeli' => 'Andy',
                'penjualan_kode'=>'26FEB09',
                'penjualan_tanggal' => '2025-02-26 13:14:00',
            ],
            [
                'penjualan_id' => 10000,
                'user_id' => 3,
                'pembeli' => 'Gege',
                'penjualan_kode'=>'26FEB10',
                'penjualan_tanggal' => '2025-02-26 13:32:00',
            ],
           
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
