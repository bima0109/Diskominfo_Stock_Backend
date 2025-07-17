<?php

namespace Database\Seeders;

use App\Models\HistoryStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HistoryStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['stock_opname_id' => 1,  'nama_barang' => 'Pulpen Standard', 'jumlah' => 100, 'satuan' => 'pcs', 'harga' => 2500, 'tanggal' => '2025-03-10'],
            ['stock_opname_id' => 2,  'nama_barang' => 'Buku Catatan', 'jumlah' => 50, 'satuan' => 'pcs', 'harga' => 12000, 'tanggal' => '2025-04-18'],
            ['stock_opname_id' => 3,  'nama_barang' => 'Kertas Fotokopi', 'jumlah' => 500, 'satuan' => 'rim', 'harga' => 40000, 'tanggal' => '2025-05-06'],
            ['stock_opname_id' => 4,  'nama_barang' => 'Stapler Kecil', 'jumlah' => 30, 'satuan' => 'pcs', 'harga' => 15000, 'tanggal' => '2025-06-12'],
            ['stock_opname_id' => 5,  'nama_barang' => 'Lem Kertas', 'jumlah' => 20, 'satuan' => 'pcs', 'harga' => 8000, 'tanggal' => '2025-07-03'],
            ['stock_opname_id' => 6,  'nama_barang' => 'Kertas Warna A4', 'jumlah' => 100, 'satuan' => 'rim', 'harga' => 25000, 'tanggal' => '2025-03-22'],
            ['stock_opname_id' => 7,  'nama_barang' => 'Spidol Marker', 'jumlah' => 40, 'satuan' => 'pcs', 'harga' => 5000, 'tanggal' => '2025-04-07'],
            ['stock_opname_id' => 8,  'nama_barang' => 'Kertas HVS A4', 'jumlah' => 200, 'satuan' => 'rim', 'harga' => 30000, 'tanggal' => '2025-06-19'],
            ['stock_opname_id' => 9,  'nama_barang' => 'Pensil HB', 'jumlah' => 150, 'satuan' => 'pcs', 'harga' => 1000, 'tanggal' => '2025-05-15'],
            ['stock_opname_id' => 10, 'nama_barang' => 'Penggaris Plastik', 'jumlah' => 75, 'satuan' => 'pcs', 'harga' => 2000, 'tanggal' => '2025-07-11'],
            ['stock_opname_id' => 11, 'nama_barang' => 'Spidol Permanen', 'jumlah' => 60, 'satuan' => 'pcs', 'harga' => 3000, 'tanggal' => '2025-03-30'],
            ['stock_opname_id' => 12, 'nama_barang' => 'Kertas Label', 'jumlah' => 30, 'satuan' => 'pack', 'harga' => 15000, 'tanggal' => '2025-04-25'],
            ['stock_opname_id' => 13, 'nama_barang' => 'Binder Ring', 'jumlah' => 20, 'satuan' => 'pack', 'harga' => 5000, 'tanggal' => '2025-06-03'],
            ['stock_opname_id' => 14, 'nama_barang' => 'Klip Besi', 'jumlah' => 100, 'satuan' => 'pack', 'harga' => 2000, 'tanggal' => '2025-07-07'],
            ['stock_opname_id' => 15, 'nama_barang' => 'Kertas Origami', 'jumlah' => 50, 'satuan' => 'pack', 'harga' => 10000, 'tanggal' => '2025-03-14'],
            ['stock_opname_id' => 16, 'nama_barang' => 'Lem Fox', 'jumlah' => 25, 'satuan' => 'pcs', 'harga' => 7000, 'tanggal' => '2025-05-28'],
            ['stock_opname_id' => 17, 'nama_barang' => 'Kertas Karton', 'jumlah' => 10, 'satuan' => 'rim', 'harga' => 50000, 'tanggal' => '2025-04-11'],
            ['stock_opname_id' => 18, 'nama_barang' => 'Pensil 2B', 'jumlah' => 80, 'satuan' => 'pcs', 'harga' => 1500, 'tanggal' => '2025-06-21'],
            ['stock_opname_id' => 19, 'nama_barang' => 'Penghapus', 'jumlah' => 60, 'satuan' => 'pcs', 'harga' => 1000, 'tanggal' => '2025-07-14'],
            ['stock_opname_id' => 20, 'nama_barang' => 'Spidol Whiteboard', 'jumlah' => 40, 'satuan' => 'pcs', 'harga' => 5000, 'tanggal' => '2025-03-19'],
            ['stock_opname_id' => 21, 'nama_barang' => 'Kertas Stiker', 'jumlah' => 25, 'satuan' => 'pack', 'harga' => 20000, 'tanggal' => '2025-05-12'],
            ['stock_opname_id' => 22, 'nama_barang' => 'Klip Kertas', 'jumlah' => 100, 'satuan' => 'pack', 'harga' => 3000, 'tanggal' => '2025-04-04'],
            ['stock_opname_id' => 23, 'nama_barang' => 'Kertas Foto Glossy', 'jumlah' => 60, 'satuan' => 'rim', 'harga' => 70000, 'tanggal' => '2025-07-20'],
            ['stock_opname_id' => 24, 'nama_barang' => 'Kertas Foto Matte', 'jumlah' => 40, 'satuan' => 'rim', 'harga' => 65000, 'tanggal' => '2025-05-05'],
            ['stock_opname_id' => 25, 'nama_barang' => 'Kertas Label Printer', 'jumlah' => 30, 'satuan' => 'pack', 'harga' => 25000, 'tanggal' => '2025-04-20'],
            ['stock_opname_id' => 26, 'nama_barang' => 'Kertas A3', 'jumlah' => 30, 'satuan' => 'rim', 'harga' => 50000, 'tanggal' => '2025-06-24'],
            ['stock_opname_id' => 27, 'nama_barang' => 'Kertas A4', 'jumlah' => 15, 'satuan' => 'rim', 'harga' => 40000, 'tanggal' => '2025-07-22'],
            ['stock_opname_id' => 28, 'nama_barang' => 'Map Folder', 'jumlah' => 75, 'satuan' => 'pcs', 'harga' => 1200, 'tanggal' => '2025-03-28'],
            ['stock_opname_id' => 29, 'nama_barang' => 'Stabilo', 'jumlah' => 30, 'satuan' => 'pcs', 'harga' => 4000, 'tanggal' => '2025-04-13'],
            ['stock_opname_id' => 30, 'nama_barang' => 'Lakban Bening', 'jumlah' => 25, 'satuan' => 'roll', 'harga' => 7000, 'tanggal' => '2025-05-01'],
            ['stock_opname_id' => 31, 'nama_barang' => 'Gunting Kertas', 'jumlah' => 10, 'satuan' => 'pcs', 'harga' => 15000, 'tanggal' => '2025-06-15'],
            ['stock_opname_id' => 32, 'nama_barang' => 'Stapler Besar', 'jumlah' => 15, 'satuan' => 'pcs', 'harga' => 35000, 'tanggal' => '2025-07-18'],
            ['stock_opname_id' => 33, 'nama_barang' => 'Pensil Warna', 'jumlah' => 100, 'satuan' => 'set', 'harga' => 20000, 'tanggal' => '2025-03-05'],
            ['stock_opname_id' => 34, 'nama_barang' => 'Label Nama', 'jumlah' => 60, 'satuan' => 'lembar', 'harga' => 1200, 'tanggal' => '2025-04-09'],
            ['stock_opname_id' => 35, 'nama_barang' => 'Kalkulator', 'jumlah' => 8, 'satuan' => 'unit', 'harga' => 75000, 'tanggal' => '2025-05-30'],
            ['stock_opname_id' => 36, 'nama_barang' => 'Binder Clip', 'jumlah' => 60, 'satuan' => 'pack', 'harga' => 4000, 'tanggal' => '2025-06-09'],
            ['stock_opname_id' => 37, 'nama_barang' => 'Amplop Coklat', 'jumlah' => 200, 'satuan' => 'pcs', 'harga' => 1000, 'tanggal' => '2025-07-27'],
            ['stock_opname_id' => 38, 'nama_barang' => 'Penggaris Besi', 'jumlah' => 40, 'satuan' => 'pcs', 'harga' => 3000, 'tanggal' => '2025-03-08'],
            ['stock_opname_id' => 39, 'nama_barang' => 'Sticky Notes', 'jumlah' => 90, 'satuan' => 'pack', 'harga' => 9000, 'tanggal' => '2025-04-14'],
            ['stock_opname_id' => 40, 'nama_barang' => 'Lem Stik', 'jumlah' => 70, 'satuan' => 'pcs', 'harga' => 5000, 'tanggal' => '2025-05-19'],
            ['stock_opname_id' => 41, 'nama_barang' => 'Stiker Label', 'jumlah' => 50, 'satuan' => 'lembar', 'harga' => 3500, 'tanggal' => '2025-06-02'],
            ['stock_opname_id' => 42, 'nama_barang' => 'Map Plastik', 'jumlah' => 85, 'satuan' => 'pcs', 'harga' => 1300, 'tanggal' => '2025-07-10'],
            ['stock_opname_id' => 43, 'nama_barang' => 'Isi Staples No.10', 'jumlah' => 120, 'satuan' => 'box', 'harga' => 5000, 'tanggal' => '2025-03-27'],
            ['stock_opname_id' => 44, 'nama_barang' => 'Pulpen Gel', 'jumlah' => 90, 'satuan' => 'pcs', 'harga' => 3500, 'tanggal' => '2025-04-16'],
            ['stock_opname_id' => 45, 'nama_barang' => 'Spidol CD', 'jumlah' => 40, 'satuan' => 'pcs', 'harga' => 4000, 'tanggal' => '2025-05-08'],
            ['stock_opname_id' => 46, 'nama_barang' => 'Penghapus Karet', 'jumlah' => 50, 'satuan' => 'pcs', 'harga' => 1000, 'tanggal' => '2025-06-26'],
            ['stock_opname_id' => 47, 'nama_barang' => 'Kalkulator Mini', 'jumlah' => 15, 'satuan' => 'unit', 'harga' => 50000, 'tanggal' => '2025-07-13'],
            ['stock_opname_id' => 48, 'nama_barang' => 'Kertas Manila', 'jumlah' => 10, 'satuan' => 'pcs', 'harga' => 2500, 'tanggal' => '2025-03-17'],
            ['stock_opname_id' => 49, 'nama_barang' => 'Pensil Mekanik', 'jumlah' => 60, 'satuan' => 'pcs', 'harga' => 6000, 'tanggal' => '2025-04-02'],
            ['stock_opname_id' => 50, 'nama_barang' => 'Penggaris Segitiga', 'jumlah' => 30, 'satuan' => 'pcs', 'harga' => 4000, 'tanggal' => '2025-05-16'],
            ['stock_opname_id' => 51, 'nama_barang' => 'Spidol Warna', 'jumlah' => 45, 'satuan' => 'pcs', 'harga' => 3000, 'tanggal' => '2025-06-05'],
            ['stock_opname_id' => 52, 'nama_barang' => 'Binder Plastik', 'jumlah' => 25, 'satuan' => 'pcs', 'harga' => 5500, 'tanggal' => '2025-07-24'],
            ['stock_opname_id' => 53, 'nama_barang' => 'Karton Dupleks', 'jumlah' => 20, 'satuan' => 'pcs', 'harga' => 7000, 'tanggal' => '2025-03-11'],
            ['stock_opname_id' => 54, 'nama_barang' => 'Label Barcode', 'jumlah' => 50, 'satuan' => 'lembar', 'harga' => 3000, 'tanggal' => '2025-04-22'],
            ['stock_opname_id' => 55, 'nama_barang' => 'Kertas Foto Premium', 'jumlah' => 60, 'satuan' => 'rim', 'harga' => 80000, 'tanggal' => '2025-05-22'],
            ['stock_opname_id' => 56, 'nama_barang' => 'Kertas Crepe', 'jumlah' => 35, 'satuan' => 'roll', 'harga' => 4500, 'tanggal' => '2025-06-18'],
            ['stock_opname_id' => 57, 'nama_barang' => 'Amplop Putih', 'jumlah' => 150, 'satuan' => 'pcs', 'harga' => 900, 'tanggal' => '2025-07-05'],
        ];


        $data = collect($data)->map(function ($item) {
            $item['tanggal'] = Carbon::parse($item['tanggal']);
            return $item;
        })->toArray();
        foreach ($data as $item) {
            echo $item['nama_barang'] . ' | Bulan: ' . $item['tanggal']->format('F') . ' | Tahun: ' . $item['tanggal']->format('Y') . "\n";
        }



        foreach ($data as $item) {
            HistoryStock::create($item);
        }
    }
}
