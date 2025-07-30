<?php

namespace Database\Seeders;

use App\Models\BarangHabis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BarangHabisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_barang' => 'Pulpen Standard',        'tanggal' => now()],
            ['nama_barang' => 'Buku Catatan',           'tanggal' => now()],
            ['nama_barang' => 'Kertas HVS A4',          'tanggal' => '2025-06-19'],
            ['nama_barang' => 'Pensil HB',              'tanggal' => '2025-05-15'],
            ['nama_barang' => 'Penggaris Plastik',      'tanggal' => '2025-07-11'],
            ['nama_barang' => 'Spidol Permanen',        'tanggal' => '2025-03-30'],
            ['nama_barang' => 'Kertas Label',           'tanggal' => '2025-04-25'],
            ['nama_barang' => 'Binder Ring',            'tanggal' => '2025-06-03'],
            ['nama_barang' => 'Klip Besi',              'tanggal' => now()],
            ['nama_barang' => 'Kertas Origami',         'tanggal' => '2025-03-14'],
            ['nama_barang' => 'Lem Fox',                'tanggal' => '2025-05-28'],
            ['nama_barang' => 'Kertas Karton',          'tanggal' => '2025-04-11'],
            ['nama_barang' => 'Pensil 2B',              'tanggal' => '2025-06-21'],
            ['nama_barang' => 'Penghapus',              'tanggal' => '2025-07-14'],
            ['nama_barang' => 'Spidol Whiteboard',      'tanggal' => '2025-03-19'],
            ['nama_barang' => 'Kertas Stiker',          'tanggal' => '2025-05-12'],
            ['nama_barang' => 'Klip Kertas',            'tanggal' => '2025-04-04'],
            ['nama_barang' => 'Kertas Foto Glossy',     'tanggal' => '2025-07-20'],
            ['nama_barang' => 'Kertas Foto Matte',      'tanggal' => '2025-05-05'],
            ['nama_barang' => 'Kertas Label Printer',   'tanggal' => '2025-04-20'],
            ['nama_barang' => 'Kertas A3',              'tanggal' => '2025-06-24'],
            ['nama_barang' => 'Kertas A4',              'tanggal' => '2025-07-22'],
            ['nama_barang' => 'Map Folder',             'tanggal' => '2025-03-28'],
            ['nama_barang' => 'Stabilo',                'tanggal' => '2025-04-13'],
            ['nama_barang' => 'Lakban Bening',          'tanggal' => '2025-05-01'],
            ['nama_barang' => 'Gunting Kertas',         'tanggal' => '2025-06-15'],
            ['nama_barang' => 'Stapler Besar',          'tanggal' => '2025-07-18'],
            ['nama_barang' => 'Pensil Warna',           'tanggal' => '2025-03-05'],
            ['nama_barang' => 'Label Nama',             'tanggal' => '2025-04-09'],
            ['nama_barang' => 'Kalkulator',             'tanggal' => '2025-05-30'],
            ['nama_barang' => 'Binder Clip',            'tanggal' => '2025-06-09'],
            ['nama_barang' => 'Amplop Coklat',          'tanggal' => '2025-07-27'],
            ['nama_barang' => 'Penggaris Besi',         'tanggal' => '2025-03-08'],
            ['nama_barang' => 'Sticky Notes',           'tanggal' => '2025-04-14'],
            ['nama_barang' => 'Lem Stik',               'tanggal' => '2025-05-19'],
            ['nama_barang' => 'Stiker Label',           'tanggal' => '2025-06-02'],
        ];



        $data = collect($data)->map(function ($item) {
            $item['tanggal'] = Carbon::parse($item['tanggal']);
            return $item;
        })->toArray();
        foreach ($data as $item) {
            echo $item['nama_barang'] . ' | Bulan: ' . $item['tanggal']->format('F') . ' | Tahun: ' . $item['tanggal']->format('Y') . "\n";
        }



        foreach ($data as $item) {
            BarangHabis::create($item);
        }
    }
}
