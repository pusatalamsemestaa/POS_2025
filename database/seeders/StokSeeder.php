<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'stok_id' => 10,
                'barang_id' => 1,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 25,
            ],
            [
                'stok_id' => 20,
                'barang_id' => 2,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 30,
            ],
            [
                'stok_id' => 30,
                'barang_id' => 3,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 20,
            ],
            [
                'stok_id' => 40,
                'barang_id' => 4,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 10,
            ],
            [
                'stok_id' => 50,
                'barang_id' => 5,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 22,
            ],
            [
                'stok_id' => 60,
                'barang_id' => 6,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 13,
            ],
            [
                'stok_id' => 70,
                'barang_id' => 7,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 27,
            ],
            [
                'stok_id' => 80,
                'barang_id' => 8,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 15,
            ],
            [
                'stok_id' => 90,
                'barang_id' => 9,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 22,
            ],
            [
                'stok_id' => 100,
                'barang_id' => 10,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 24,
            ],
            [
                'stok_id' => 110,
                'barang_id' => 11,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 28,
            ],
            [
                'stok_id' => 120,
                'barang_id' => 12,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 20,
            ],
            [
                'stok_id' => 130,
                'barang_id' => 13,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 25,
            ],
            [
                'stok_id' => 140,
                'barang_id' => 14,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 15,
            ],
            [
                'stok_id' => 150,
                'barang_id' => 15,
                'user_id' => 1,
                'stok_tanggal' => '2025-02-27 14:30:00',
                'stok_jumlah' => 30,
            ],
        ];
        DB::table('t_stok')->insert($data);
    }
}
