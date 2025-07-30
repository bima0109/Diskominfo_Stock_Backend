<?php

namespace Database\Seeders;

use App\Models\BarangMasih;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BarangMasihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            ['nama_barang' => 'Pulpen Standard', 'jumlah' => 10, 'satuan' => 'pcs', 'tanggal' => now()],
            ['nama_barang' => 'Buku Catatan', 'jumlah' => 10, 'satuan' => 'pcs', 'tanggal' => now()],
            ['nama_barang' => 'Kertas Fotokopi', 'jumlah' => 50, 'satuan' => 'rim', 'tanggal' => '2025-05-06'],
            ['nama_barang' => 'Stapler Kecil', 'jumlah' => 8, 'satuan' => 'pcs', 'tanggal' => '2025-06-12'],
            ['nama_barang' => 'Klip Besi', 'jumlah' => 31, 'satuan' => 'pack', 'tanggal' => now()],
            ['nama_barang' => 'Kertas Origami', 'jumlah' => 8, 'satuan' => 'pack', 'tanggal' => '2025-03-14'],
            ['nama_barang' => 'Lem Fox', 'jumlah' => 3, 'satuan' => 'pcs', 'tanggal' => '2025-05-28'],
            ['nama_barang' => 'Kertas Karton', 'jumlah' => 7, 'satuan' => 'rim', 'tanggal' => '2025-04-11'],
            ['nama_barang' => 'Pensil 2B', 'jumlah' => 23, 'satuan' => 'pcs', 'tanggal' => '2025-06-21'],
            ['nama_barang' => 'Penghapus', 'jumlah' => 6, 'satuan' => 'pcs', 'tanggal' => '2025-07-14'],
            ['nama_barang' => 'Spidol Whiteboard', 'jumlah' => 12, 'satuan' => 'pcs', 'tanggal' => '2025-03-19'],
            ['nama_barang' => 'Kertas Stiker', 'jumlah' => 15, 'satuan' => 'pack', 'tanggal' => '2025-05-12'],
            ['nama_barang' => 'Klip Kertas', 'jumlah' => 20, 'satuan' => 'pack', 'tanggal' => '2025-04-04'],
            ['nama_barang' => 'Kertas Foto Glossy', 'jumlah' => 10, 'satuan' => 'rim', 'tanggal' => '2025-07-20'],
            ['nama_barang' => 'Kertas Foto Matte', 'jumlah' => 1, 'satuan' => 'rim', 'tanggal' => '2025-05-05'],
            ['nama_barang' => 'Kertas Label Printer', 'jumlah' => 5, 'satuan' => 'pack', 'tanggal' => '2025-04-20'],
            ['nama_barang' => 'Kertas A3', 'jumlah' => 12, 'satuan' => 'rim', 'tanggal' => '2025-06-24'],
            ['nama_barang' => 'Kertas A4', 'jumlah' => 12, 'satuan' => 'rim', 'tanggal' => '2025-07-22'],
            ['nama_barang' => 'Map Folder', 'jumlah' => 21, 'satuan' => 'pcs', 'tanggal' => '2025-03-28'],
            ['nama_barang' => 'Stabilo', 'jumlah' => 23, 'satuan' => 'pcs', 'tanggal' => '2025-04-13'],
            ['nama_barang' => 'Lakban Bening', 'jumlah' => 4, 'satuan' => 'roll', 'tanggal' => '2025-05-01'],
            ['nama_barang' => 'Stiker Label', 'jumlah' => 12, 'satuan' => 'lembar', 'tanggal' => '2025-06-02'],
            ['nama_barang' => 'Map Plastik', 'jumlah' => 33, 'satuan' => 'pcs', 'tanggal' => '2025-07-10'],
            ['nama_barang' => 'Isi Staples No.10', 'jumlah' => 22, 'satuan' => 'box', 'tanggal' => '2025-03-27'],
            ['nama_barang' => 'Pulpen Gel', 'jumlah' => 19, 'satuan' => 'pcs', 'tanggal' => '2025-04-16'],
            ['nama_barang' => 'Spidol CD', 'jumlah' => 16, 'satuan' => 'pcs', 'tanggal' => '2025-05-08'],
            ['nama_barang' => 'Penghapus Karet', 'jumlah' => 33, 'satuan' => 'pcs', 'tanggal' => '2025-06-26'],
            ['nama_barang' => 'Kalkulator Mini', 'jumlah' => 3, 'satuan' => 'unit', 'tanggal' => '2025-07-13'],
            ['nama_barang' => 'Kertas Manila', 'jumlah' => 7, 'satuan' => 'pcs', 'tanggal' => '2025-03-17'],
            ['nama_barang' => 'Pensil Mekanik', 'jumlah' => 19, 'satuan' => 'pcs', 'tanggal' => '2025-04-02'],
            ['nama_barang' => 'Penggaris Segitiga', 'jumlah' => 14, 'satuan' => 'pcs', 'tanggal' => '2025-05-16'],
            ['nama_barang' => 'Spidol Warna', 'jumlah' => 4, 'satuan' => 'pcs', 'tanggal' => '2025-06-05'],
            ['nama_barang' => 'Binder Plastik', 'jumlah' => 5, 'satuan' => 'pcs', 'tanggal' => '2025-07-24'],
            ['nama_barang' => 'Karton Dupleks', 'jumlah' => 8, 'satuan' => 'pcs', 'tanggal' => '2025-03-11'],
            ['nama_barang' => 'Label Barcode', 'jumlah' => 23, 'satuan' => 'lembar', 'tanggal' => '2025-04-22'],
            ['nama_barang' => 'Kertas Foto Premium', 'jumlah' => 29, 'satuan' => 'rim', 'tanggal' => '2025-05-22'],
            ['nama_barang' => 'Kertas Crepe', 'jumlah' => 3, 'satuan' => 'roll', 'tanggal' => '2025-06-18'],
            ['nama_barang' => 'Amplop Putih', 'jumlah' => 28, 'satuan' => 'pcs', 'tanggal' => '2025-07-05'],
        ];


        $data = collect($data)->map(function ($item) {
            $item['tanggal'] = Carbon::parse($item['tanggal']);
            return $item;
        })->toArray();
        foreach ($data as $item) {
            echo $item['nama_barang'] . ' | Bulan: ' . $item['tanggal']->format('F') . ' | Tahun: ' . $item['tanggal']->format('Y') . "\n";
        }



        foreach ($data as $item) {
            BarangMasih::create($item);
        }
    }
}
