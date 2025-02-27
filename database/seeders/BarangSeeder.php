<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'ANS1',
                'barang_nama' => 'Katsu Matah Wangi',
                'harga_beli' => 12000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'ANS2',
                'barang_nama' => 'Sup Merah Juara',
                'harga_beli' => 10000,
                'harga_jual' => 22000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 1,
                'barang_kode' => 'ANS3',
                'barang_nama' => 'Nasi Ayam Pedas Asin',
                'harga_beli' => 12000,
                'harga_jual' => 18000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 1,
                'barang_kode' => 'ANS4',
                'barang_nama' => 'Nasi Telur Ibu ',
                'harga_beli' => 8000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 2,
                'barang_kode' => 'ANS5',
                'barang_nama' => 'Enoki Furai',
                'harga_beli' => 6000,
                'harga_jual' => 18000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 2,
                'barang_kode' => 'ANS6',
                'barang_nama' => 'Donat Urban',
                'harga_beli' => 8000,
                'harga_jual' => 18000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 3,
                'barang_kode' => 'ANS7',
                'barang_nama' => 'Anasera Ice Coffee',
                'harga_beli' => 7000,
                'harga_jual' => 18000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 3,
                'barang_kode' => 'ANS8',
                'barang_nama' => 'Bittar Bitter',
                'harga_beli' => 8000,
                'harga_jual' => 22000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 3,
                'barang_kode' => 'ANS9',
                'barang_nama' => 'Butterstoch Latte',
                'harga_beli' => 12000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 3,
                'barang_kode' => 'ANS10',
                'barang_nama' => 'Doubledosh Shaken Latte',
                'harga_beli' => 12000,
                'harga_jual' => 22000,
            ],
            [
                'barang_id' => 11,
                'kategori_id' => 4,
                'barang_kode' => 'ANS11',
                'barang_nama' => 'Nutty Matcha',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 12,
                'kategori_id' => 4,
                'barang_kode' => 'ANS12',
                'barang_nama' => 'Cookies & Cream',
                'harga_beli' => 9000,
                'harga_jual' => 22000,
            ],
            [
                'barang_id' => 13,
                'kategori_id' => 4,
                'barang_kode' => 'ANS13',
                'barang_nama' => 'Blue Sky',
                'harga_beli' => 10000,
                'harga_jual' => 18000,
            ],
            [
                'barang_id' => 14,
                'kategori_id' => 5,
                'barang_kode' => 'ANS14',
                'barang_nama' => 'Croisant Butter',
                'harga_beli' => 6000,
                'harga_jual' => 18000,
            ],
            [
                'barang_id' => 15,
                'kategori_id' => 5,
                'barang_kode' => 'ANS15',
                'barang_nama' => 'Bagel',
                'harga_beli' => 6000,
                'harga_jual' => 22000,
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
