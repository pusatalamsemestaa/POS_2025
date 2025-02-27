<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'detail_id' => 10001,
                'penjualan_id' => 1000,
                'barang_id' => 2,
                'harga' => 22000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 10002,
                'penjualan_id' => 1000,
                'barang_id' => 13,
                'harga' => 18000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 10003,
                'penjualan_id' => 1000,
                'barang_id' => 7,
                'harga' => 18000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 10004,
                'penjualan_id' => 2000,
                'barang_id' => 4,
                'harga' => 20000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 10005,
                'penjualan_id' => 2000,
                'barang_id' => 9,
                'harga' => 20000,
                'jumlah' => 4,
            ],
            [
                'detail_id' => 10006,
                'penjualan_id' => 2000,
                'barang_id' => 11,
                'harga' => 20000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 10007,
                'penjualan_id' => 3000,
                'barang_id' => 15,
                'harga' => 22000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 10008,
                'penjualan_id' => 3000,
                'barang_id' => 12 ,
                'harga' => 22000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 10009,
                'penjualan_id' => 3000,
                'barang_id' => 8,
                'harga' => 22000,
                'jumlah' => 4,
            ],
            [
                'detail_id' => 10010,
                'penjualan_id' => 4000,
                'barang_id' => 4,
                'harga' => 20000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 10011,
                'penjualan_id' => 4000,
                'barang_id' => 7 ,
                'harga' => 18000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 10012,
                'penjualan_id' => 4000,
                'barang_id' => 9,
                'harga' => 20000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 10013,
                'penjualan_id' => 5000,
                'barang_id' => 3,
                'harga' => 18000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 10014,
                'penjualan_id' => 5000,
                'barang_id' => 6,
                'harga' => 18000,
                'jumlah' => 4,
            ],
            [
                'detail_id' => 10015,
                'penjualan_id' => 5000,
                'barang_id' => 2,
                'harga' => 22000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 10016,
                'penjualan_id' => 6000,
                'barang_id' => 1,
                'harga' => 20000,
                'jumlah' => 4,
            ],
            [
                'detail_id' => 10017,
                'penjualan_id' => 6000,
                'barang_id' => 5,
                'harga' => 18000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 10018,
                'penjualan_id' => 6000,
                'barang_id' => 11,
                'harga' => 20000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 10019,
                'penjualan_id' => 7000,
                'barang_id' => 4,
                'harga' => 20000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 10020,
                'penjualan_id' => 7000,
                'barang_id' => 8,
                'harga' => 22000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 10021,
                'penjualan_id' => 7000,
                'barang_id' => 9,
                'harga' => 20000,
                'jumlah' => 5,
            ],
            [
                'detail_id' => 10022,
                'penjualan_id' => 8000,
                'barang_id' => 2,
                'harga' => 22000,
                'jumlah' => 4,
            ],
            [
                'detail_id' => 10023,
                'penjualan_id' => 8000,
                'barang_id' => 9,
                'harga' => 20000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 10024,
                'penjualan_id' => 8000,
                'barang_id' => 10,
                'harga' => 22000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 10025,
                'penjualan_id' => 9000,
                'barang_id' => 3,
                'harga' => 18000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 10026,
                'penjualan_id' => 9000,
                'barang_id' => 13,
                'harga' => 18000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 10027,
                'penjualan_id' => 9000,
                'barang_id' => 15,
                'harga' => 22000,
                'jumlah' => 1,
            ],
            [
                'detail_id' => 10028,
                'penjualan_id' => 10000,
                'barang_id' => 6,
                'harga' => 18000,
                'jumlah' => 2,
            ],
            [
                'detail_id' => 10029,
                'penjualan_id' => 10000,
                'barang_id' => 14,
                'harga' => 18000,
                'jumlah' => 3,
            ],
            [
                'detail_id' => 10030,
                'penjualan_id' => 10000,
                'barang_id' => 2,
                'harga' => 22000,
                'jumlah' => 4,
            ],
        ];
        DB::table('t_penjualan_detail')->insert($data);
    }
}
