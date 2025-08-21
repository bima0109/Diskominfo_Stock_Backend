<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockOpname;
use Carbon\Carbon;

class StockOpnameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            ['nama_barang' => 'Pulpen Standard', 'jumlah' => 100, 'satuan' => 'pcs', 'harga' => 2500, 'tanggal' => '2025-01-05'],
            ['nama_barang' => 'Buku Catatan', 'jumlah' => 50, 'satuan' => 'pcs', 'harga' => 7500, 'tanggal' => '2025-01-12'],
            ['nama_barang' => 'Kertas Fotokopi', 'jumlah' => 500, 'satuan' => 'rim', 'harga' => 35000, 'tanggal' => '2025-01-18'],
            ['nama_barang' => 'Stapler Kecil', 'jumlah' => 30, 'satuan' => 'pcs', 'harga' => 15000, 'tanggal' => '2025-01-25'],
            ['nama_barang' => 'Lem Kertas', 'jumlah' => 20, 'satuan' => 'pcs', 'harga' => 5000, 'tanggal' => '2025-02-02'],
            ['nama_barang' => 'Kertas Warna A4', 'jumlah' => 100, 'satuan' => 'rim', 'harga' => 40000, 'tanggal' => '2025-02-08'],
            ['nama_barang' => 'Spidol Marker', 'jumlah' => 40, 'satuan' => 'pcs', 'harga' => 8000, 'tanggal' => '2025-02-15'],
            ['nama_barang' => 'Kertas HVS A4', 'jumlah' => 200, 'satuan' => 'rim', 'harga' => 36000, 'tanggal' => '2025-02-22'],
            ['nama_barang' => 'Pensil HB', 'jumlah' => 150, 'satuan' => 'pcs', 'harga' => 2000, 'tanggal' => '2025-02-27'],
            ['nama_barang' => 'Penggaris Plastik', 'jumlah' => 75, 'satuan' => 'pcs', 'harga' => 3000, 'tanggal' => '2025-03-03'],

            ['nama_barang' => 'Spidol Permanen', 'jumlah' => 60, 'satuan' => 'pcs', 'harga' => 9000, 'tanggal' => '2025-03-09'],
            ['nama_barang' => 'Kertas Label', 'jumlah' => 30, 'satuan' => 'pack', 'harga' => 25000, 'tanggal' => '2025-03-14'],
            ['nama_barang' => 'Binder Ring', 'jumlah' => 20, 'satuan' => 'pack', 'harga' => 18000, 'tanggal' => '2025-03-19'],
            ['nama_barang' => 'Klip Besi', 'jumlah' => 100, 'satuan' => 'pack', 'harga' => 10000, 'tanggal' => '2025-03-23'],
            ['nama_barang' => 'Kertas Origami', 'jumlah' => 50, 'satuan' => 'pack', 'harga' => 20000, 'tanggal' => '2025-03-28'],
            ['nama_barang' => 'Lem Fox', 'jumlah' => 25, 'satuan' => 'pcs', 'harga' => 6000, 'tanggal' => '2025-04-02'],
            ['nama_barang' => 'Kertas Karton', 'jumlah' => 10, 'satuan' => 'rim', 'harga' => 45000, 'tanggal' => '2025-04-07'],
            ['nama_barang' => 'Pensil 2B', 'jumlah' => 80, 'satuan' => 'pcs', 'harga' => 2500, 'tanggal' => '2025-04-12'],
            ['nama_barang' => 'Penghapus', 'jumlah' => 60, 'satuan' => 'pcs', 'harga' => 1500, 'tanggal' => '2025-04-16'],
            ['nama_barang' => 'Spidol Whiteboard', 'jumlah' => 40, 'satuan' => 'pcs', 'harga' => 8500, 'tanggal' => '2025-04-21'],

            ['nama_barang' => 'Map Plastik', 'jumlah' => 70, 'satuan' => 'pcs', 'harga' => 3000, 'tanggal' => '2025-04-27'],
            ['nama_barang' => 'Box Arsip', 'jumlah' => 35, 'satuan' => 'pcs', 'harga' => 12000, 'tanggal' => '2025-05-03'],
            ['nama_barang' => 'Lakban Coklat', 'jumlah' => 50, 'satuan' => 'roll', 'harga' => 7000, 'tanggal' => '2025-05-08'],
            ['nama_barang' => 'Kalkulator', 'jumlah' => 15, 'satuan' => 'pcs', 'harga' => 45000, 'tanggal' => '2025-05-13'],
            ['nama_barang' => 'Penghapus Papan', 'jumlah' => 20, 'satuan' => 'pcs', 'harga' => 5000, 'tanggal' => '2025-05-17'],
            ['nama_barang' => 'Buku Agenda', 'jumlah' => 25, 'satuan' => 'pcs', 'harga' => 20000, 'tanggal' => '2025-05-22'],
            ['nama_barang' => 'Highlighter', 'jumlah' => 30, 'satuan' => 'pcs', 'harga' => 9000, 'tanggal' => '2025-05-26'],
            ['nama_barang' => 'Cutter', 'jumlah' => 40, 'satuan' => 'pcs', 'harga' => 10000, 'tanggal' => '2025-05-31'],
            ['nama_barang' => 'Isi Cutter', 'jumlah' => 60, 'satuan' => 'pack', 'harga' => 5000, 'tanggal' => '2025-06-04'],
            ['nama_barang' => 'Amplop Coklat', 'jumlah' => 100, 'satuan' => 'pcs', 'harga' => 2000, 'tanggal' => '2025-06-08'],

            ['nama_barang' => 'Sticky Notes', 'jumlah' => 80, 'satuan' => 'pack', 'harga' => 12000, 'tanggal' => '2025-06-13'],
            ['nama_barang' => 'Paper Clip', 'jumlah' => 120, 'satuan' => 'box', 'harga' => 5000, 'tanggal' => '2025-06-18'],
            ['nama_barang' => 'Flashdisk 16GB', 'jumlah' => 20, 'satuan' => 'pcs', 'harga' => 70000, 'tanggal' => '2025-06-22'],
            ['nama_barang' => 'Flashdisk 32GB', 'jumlah' => 15, 'satuan' => 'pcs', 'harga' => 120000, 'tanggal' => '2025-06-27'],
            ['nama_barang' => 'Stopmap Kertas', 'jumlah' => 90, 'satuan' => 'pcs', 'harga' => 1500, 'tanggal' => '2025-07-01'],
            ['nama_barang' => 'Stempel Kayu', 'jumlah' => 10, 'satuan' => 'pcs', 'harga' => 35000, 'tanggal' => '2025-07-06'],
            ['nama_barang' => 'Tinta Stempel', 'jumlah' => 25, 'satuan' => 'pcs', 'harga' => 10000, 'tanggal' => '2025-07-10'],
            ['nama_barang' => 'Binder A4', 'jumlah' => 30, 'satuan' => 'pcs', 'harga' => 25000, 'tanggal' => '2025-07-15'],
            ['nama_barang' => 'Binder B5', 'jumlah' => 20, 'satuan' => 'pcs', 'harga' => 20000, 'tanggal' => '2025-07-20'],
            ['nama_barang' => 'Tas Arsip', 'jumlah' => 15, 'satuan' => 'pcs', 'harga' => 40000, 'tanggal' => '2025-07-25'],

            ['nama_barang' => 'Dispenser Air', 'jumlah' => 5, 'satuan' => 'unit', 'harga' => 300000, 'tanggal' => '2025-07-30'],
            ['nama_barang' => 'Gelas Plastik', 'jumlah' => 200, 'satuan' => 'pcs', 'harga' => 500, 'tanggal' => '2025-08-04'],
            ['nama_barang' => 'Kopi Sachet', 'jumlah' => 100, 'satuan' => 'pcs', 'harga' => 1500, 'tanggal' => '2025-08-08'],
            ['nama_barang' => 'Teh Celup', 'jumlah' => 50, 'satuan' => 'box', 'harga' => 10000, 'tanggal' => '2025-08-12'],
            ['nama_barang' => 'Gula Pasir 1kg', 'jumlah' => 30, 'satuan' => 'kg', 'harga' => 15000, 'tanggal' => '2025-08-16'],
            ['nama_barang' => 'Susu Bubuk', 'jumlah' => 20, 'satuan' => 'pack', 'harga' => 45000, 'tanggal' => '2025-08-20'],
            ['nama_barang' => 'Kopi Bubuk', 'jumlah' => 15, 'satuan' => 'pack', 'harga' => 35000, 'tanggal' => '2025-08-24'],
            ['nama_barang' => 'Tisu Kotak', 'jumlah' => 60, 'satuan' => 'pcs', 'harga' => 8000, 'tanggal' => '2025-08-28'],
            ['nama_barang' => 'Tisu Gulung', 'jumlah' => 40, 'satuan' => 'pcs', 'harga' => 10000, 'tanggal' => '2025-09-01'],
            ['nama_barang' => 'Masker Medis', 'jumlah' => 200, 'satuan' => 'box', 'harga' => 30000, 'tanggal' => '2025-09-05'],

            ['nama_barang' => 'Hand Sanitizer', 'jumlah' => 50, 'satuan' => 'botol', 'harga' => 25000, 'tanggal' => '2025-09-10'],
            ['nama_barang' => 'Sabun Cuci Tangan', 'jumlah' => 40, 'satuan' => 'botol', 'harga' => 15000, 'tanggal' => '2025-09-15'],
            ['nama_barang' => 'Sapu Lantai', 'jumlah' => 20, 'satuan' => 'pcs', 'harga' => 25000, 'tanggal' => '2025-09-19'],
            ['nama_barang' => 'Pel Lantai', 'jumlah' => 20, 'satuan' => 'pcs', 'harga' => 30000, 'tanggal' => '2025-09-23'],
            ['nama_barang' => 'Ember Plastik', 'jumlah' => 15, 'satuan' => 'pcs', 'harga' => 20000, 'tanggal' => '2025-09-27'],
            ['nama_barang' => 'Kemoceng', 'jumlah' => 25, 'satuan' => 'pcs', 'harga' => 10000, 'tanggal' => '2025-10-01'],
            ['nama_barang' => 'Lap Kanebo', 'jumlah' => 30, 'satuan' => 'pcs', 'harga' => 15000, 'tanggal' => '2025-10-05'],
            ['nama_barang' => 'Sapu Ijuk', 'jumlah' => 25, 'satuan' => 'pcs', 'harga' => 18000, 'tanggal' => '2025-10-09'],
            ['nama_barang' => 'Tempat Sampah', 'jumlah' => 10, 'satuan' => 'pcs', 'harga' => 35000, 'tanggal' => '2025-10-13'],
            ['nama_barang' => 'Kabel Roll', 'jumlah' => 8, 'satuan' => 'pcs', 'harga' => 75000, 'tanggal' => '2025-10-17'],

        ];

        $data = collect($data)->map(function ($item) {
            $item['tanggal'] = Carbon::parse($item['tanggal']);
            return $item;
        })->toArray();
        foreach ($data as $item) {
            echo $item['nama_barang'] . ' | Bulan: ' . $item['tanggal']->format('F') . ' | Tahun: ' . $item['tanggal']->format('Y') . "\n";
        }

        foreach ($data as $item) {
            StockOpname::create($item);
        }
    }
}
