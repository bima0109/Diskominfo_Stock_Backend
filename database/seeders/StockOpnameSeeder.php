<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockOpname;

class StockOpnameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_barang' => 'Pulpen Standard', 'jumlah' => 100, 'satuan' => 'pcs', 'harga' => 2500],
            ['nama_barang' => 'Pensil 2B', 'jumlah' => 80, 'satuan' => 'pcs', 'harga' => 1500],
            ['nama_barang' => 'Penghapus', 'jumlah' => 60, 'satuan' => 'pcs', 'harga' => 1000],
            ['nama_barang' => 'Spidol Whiteboard', 'jumlah' => 40, 'satuan' => 'pcs', 'harga' => 5000],
            ['nama_barang' => 'Kertas A4', 'jumlah' => 20, 'satuan' => 'rim', 'harga' => 35000],
            ['nama_barang' => 'Map Folder', 'jumlah' => 75, 'satuan' => 'pcs', 'harga' => 1200],
            ['nama_barang' => 'Stabilo', 'jumlah' => 30, 'satuan' => 'pcs', 'harga' => 4000],
            ['nama_barang' => 'Lakban Bening', 'jumlah' => 25, 'satuan' => 'roll', 'harga' => 7000],
            ['nama_barang' => 'Gunting Kertas', 'jumlah' => 10, 'satuan' => 'pcs', 'harga' => 15000],
            ['nama_barang' => 'Stapler Besar', 'jumlah' => 15, 'satuan' => 'pcs', 'harga' => 35000],
            ['nama_barang' => 'Isi Staples No.10', 'jumlah' => 100, 'satuan' => 'box', 'harga' => 5000],
            ['nama_barang' => 'Penggaris 30cm', 'jumlah' => 50, 'satuan' => 'pcs', 'harga' => 2500],
            ['nama_barang' => 'Kalkulator', 'jumlah' => 8, 'satuan' => 'unit', 'harga' => 75000],
            ['nama_barang' => 'Binder Clip', 'jumlah' => 60, 'satuan' => 'pack', 'harga' => 4000],
            ['nama_barang' => 'Amplop Coklat', 'jumlah' => 200, 'satuan' => 'pcs', 'harga' => 1000],
        ];

        foreach ($data as $item) {
            StockOpname::create($item);
        }
    }
}
