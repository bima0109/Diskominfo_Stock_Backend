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

            ['nama_barang' => 'Pulpen Standard', 'jumlah' => 100, 'satuan' => 'pcs', 'tanggal' => now()],
            ['nama_barang' => 'Buku Catatan', 'jumlah' => 50, 'satuan' => 'pcs', 'tanggal' => now()],
            ['nama_barang' => 'Kertas Fotokopi', 'jumlah' => 500, 'satuan' => 'rim', 'tanggal' => '2025-05-06'],
            ['nama_barang' => 'Stapler Kecil', 'jumlah' => 30, 'satuan' => 'pcs', 'tanggal' => '2025-06-12'],
            ['nama_barang' => 'Lem Kertas', 'jumlah' => 20, 'satuan' => 'pcs', 'tanggal' => '2025-07-03'],
            ['nama_barang' => 'Kertas Warna A4', 'jumlah' => 100, 'satuan' => 'rim', 'tanggal' => '2025-03-22'],
            ['nama_barang' => 'Spidol Marker', 'jumlah' => 40, 'satuan' => 'pcs', 'tanggal' => '2025-04-07'],
            ['nama_barang' => 'Kertas HVS A4', 'jumlah' => 200, 'satuan' => 'rim', 'tanggal' => '2025-06-19'],
            ['nama_barang' => 'Pensil HB', 'jumlah' => 150, 'satuan' => 'pcs', 'tanggal' => '2025-05-15'],
            ['nama_barang' => 'Penggaris Plastik', 'jumlah' => 75, 'satuan' => 'pcs', 'tanggal' => '2025-07-11'],
            ['nama_barang' => 'Spidol Permanen', 'jumlah' => 60, 'satuan' => 'pcs', 'tanggal' => '2025-03-30'],
            ['nama_barang' => 'Kertas Label', 'jumlah' => 30, 'satuan' => 'pack', 'tanggal' => '2025-04-25'],
            ['nama_barang' => 'Binder Ring', 'jumlah' => 20, 'satuan' => 'pack', 'tanggal' => '2025-06-03'],
            ['nama_barang' => 'Klip Besi', 'jumlah' => 100, 'satuan' => 'pack', 'tanggal' => now()],
            ['nama_barang' => 'Kertas Origami', 'jumlah' => 50, 'satuan' => 'pack', 'tanggal' => '2025-03-14'],
            ['nama_barang' => 'Lem Fox', 'jumlah' => 25, 'satuan' => 'pcs', 'tanggal' => '2025-05-28'],
            ['nama_barang' => 'Kertas Karton', 'jumlah' => 10, 'satuan' => 'rim', 'tanggal' => '2025-04-11'],
            ['nama_barang' => 'Pensil 2B', 'jumlah' => 80, 'satuan' => 'pcs', 'tanggal' => '2025-06-21'],
            ['nama_barang' => 'Penghapus', 'jumlah' => 60, 'satuan' => 'pcs', 'tanggal' => '2025-07-14'],
            ['nama_barang' => 'Spidol Whiteboard', 'jumlah' => 40, 'satuan' => 'pcs', 'tanggal' => '2025-03-19'],
            ['nama_barang' => 'Kertas Stiker', 'jumlah' => 25, 'satuan' => 'pack', 'tanggal' => '2025-05-12'],
            ['nama_barang' => 'Klip Kertas', 'jumlah' => 100, 'satuan' => 'pack', 'tanggal' => '2025-04-04'],
            ['nama_barang' => 'Kertas Foto Glossy', 'jumlah' => 60, 'satuan' => 'rim', 'tanggal' => '2025-07-20'],
            ['nama_barang' => 'Kertas Foto Matte', 'jumlah' => 40, 'satuan' => 'rim', 'tanggal' => '2025-05-05'],
            ['nama_barang' => 'Kertas Label Printer', 'jumlah' => 30, 'satuan' => 'pack', 'tanggal' => '2025-04-20'],
            ['nama_barang' => 'Kertas A3', 'jumlah' => 30, 'satuan' => 'rim', 'tanggal' => '2025-06-24'],
            ['nama_barang' => 'Kertas A4', 'jumlah' => 15, 'satuan' => 'rim', 'tanggal' => '2025-07-22'],
            ['nama_barang' => 'Map Folder', 'jumlah' => 75, 'satuan' => 'pcs', 'tanggal' => '2025-03-28'],
            ['nama_barang' => 'Stabilo', 'jumlah' => 30, 'satuan' => 'pcs', 'tanggal' => '2025-04-13'],
            ['nama_barang' => 'Lakban Bening', 'jumlah' => 25, 'satuan' => 'roll', 'tanggal' => '2025-05-01'],
            ['nama_barang' => 'Gunting Kertas', 'jumlah' => 10, 'satuan' => 'pcs', 'tanggal' => '2025-06-15'],
            ['nama_barang' => 'Stapler Besar', 'jumlah' => 15, 'satuan' => 'pcs', 'tanggal' => '2025-07-18'],
            ['nama_barang' => 'Pensil Warna', 'jumlah' => 100, 'satuan' => 'set', 'tanggal' => '2025-03-05'],
            ['nama_barang' => 'Label Nama', 'jumlah' => 60, 'satuan' => 'lembar', 'tanggal' => '2025-04-09'],
            ['nama_barang' => 'Kalkulator', 'jumlah' => 8, 'satuan' => 'unit', 'tanggal' => '2025-05-30'],
            ['nama_barang' => 'Binder Clip', 'jumlah' => 60, 'satuan' => 'pack', 'tanggal' => '2025-06-09'],
            ['nama_barang' => 'Amplop Coklat', 'jumlah' => 200, 'satuan' => 'pcs', 'tanggal' => '2025-07-27'],
            ['nama_barang' => 'Penggaris Besi', 'jumlah' => 40, 'satuan' => 'pcs', 'tanggal' => '2025-03-08'],
            ['nama_barang' => 'Sticky Notes', 'jumlah' => 90, 'satuan' => 'pack', 'tanggal' => '2025-04-14'],
            ['nama_barang' => 'Lem Stik', 'jumlah' => 70, 'satuan' => 'pcs', 'tanggal' => '2025-05-19'],
            ['nama_barang' => 'Stiker Label', 'jumlah' => 50, 'satuan' => 'lembar', 'tanggal' => '2025-06-02'],
            ['nama_barang' => 'Map Plastik', 'jumlah' => 85, 'satuan' => 'pcs', 'tanggal' => '2025-07-10'],
            ['nama_barang' => 'Isi Staples No.10', 'jumlah' => 120, 'satuan' => 'box', 'tanggal' => '2025-03-27'],
            ['nama_barang' => 'Pulpen Gel', 'jumlah' => 90, 'satuan' => 'pcs', 'tanggal' => '2025-04-16'],
            ['nama_barang' => 'Spidol CD', 'jumlah' => 40, 'satuan' => 'pcs', 'tanggal' => '2025-05-08'],
            ['nama_barang' => 'Penghapus Karet', 'jumlah' => 50, 'satuan' => 'pcs', 'tanggal' => '2025-06-26'],
            ['nama_barang' => 'Kalkulator Mini', 'jumlah' => 15, 'satuan' => 'unit', 'tanggal' => '2025-07-13'],
            ['nama_barang' => 'Kertas Manila', 'jumlah' => 10, 'satuan' => 'pcs', 'tanggal' => '2025-03-17'],
            ['nama_barang' => 'Pensil Mekanik', 'jumlah' => 60, 'satuan' => 'pcs', 'tanggal' => '2025-04-02'],
            ['nama_barang' => 'Penggaris Segitiga', 'jumlah' => 30, 'satuan' => 'pcs', 'tanggal' => '2025-05-16'],
            ['nama_barang' => 'Spidol Warna', 'jumlah' => 45, 'satuan' => 'pcs', 'tanggal' => '2025-06-05'],
            ['nama_barang' => 'Binder Plastik', 'jumlah' => 25, 'satuan' => 'pcs', 'tanggal' => '2025-07-24'],
            ['nama_barang' => 'Karton Dupleks', 'jumlah' => 20, 'satuan' => 'pcs', 'tanggal' => '2025-03-11'],
            ['nama_barang' => 'Label Barcode', 'jumlah' => 50, 'satuan' => 'lembar', 'tanggal' => '2025-04-22'],
            ['nama_barang' => 'Kertas Foto Premium', 'jumlah' => 60, 'satuan' => 'rim', 'tanggal' => '2025-05-22'],
            ['nama_barang' => 'Kertas Crepe', 'jumlah' => 35, 'satuan' => 'roll', 'tanggal' => '2025-06-18'],
            ['nama_barang' => 'Amplop Putih', 'jumlah' => 150, 'satuan' => 'pcs', 'tanggal' => '2025-07-05'],
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
