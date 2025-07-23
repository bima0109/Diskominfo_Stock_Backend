<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermintaanSeeder extends Seeder
{
    public function run()
    {
        DB::table('permintaans')->insert([
            [
                'nama_barang' => 'Pulpen Standard',
                'jumlah' => 10,
                'satuan' => 'pcs',
                'id_stock_opname' => 1,
                'tanggal' => Carbon::parse('2025-07-01'),
                'keterangan' => '-',
                'id_bidang' => 1,
                'id_user' => 2,
                'status' => 'ACC KABID',
            ],
            [
                'nama_barang' => 'Buku Catatan',
                'jumlah' => 19,
                'satuan' => 'pcs',
                'id_stock_opname' => 2,
                'tanggal' => Carbon::parse('2025-07-02'),
                'keterangan' => 'Kebutuhan rapat',
                'id_bidang' => 2,
                'id_user' => 3,
                'status' => 'ACC UMPEG',
            ],
            [
                'nama_barang' => 'Kertas Fotokopi',
                'jumlah' => 20,
                'satuan' => 'rim',
                'id_stock_opname' => 3,
                'tanggal' => '2025-05-06',
                'keterangan' => 'Untuk printer umum',
                'id_bidang' => 3,
                'id_user' => 4,
                'status' => 'DITOLAK',
            ],
            [
                'nama_barang' => 'Stapler Kecil',
                'jumlah' => 10,
                'satuan' => 'pcs',
                'id_stock_opname' => 4,
                'tanggal' => '2025-06-12',
                'keterangan' => 'Pengganti alat rusak',
                'id_bidang' => 4,
                'id_user' => 5,
                'status' => 'ACC PPTKSEKRETARIAT',
            ],
            [
                'nama_barang' => 'Lem Kertas',
                'jumlah' => 5,
                'satuan' => 'pcs',
                'id_stock_opname' => 5,
                'tanggal' => '2025-07-03',
                'keterangan' => 'Kebutuhan harian',
                'id_bidang' => 5,
                'id_user' => 6,
                'status' => 'ACC KABID',
            ],
            [
                'nama_barang' => 'Kertas Warna A4',
                'jumlah' => 20,
                'satuan' => 'rim',
                'id_stock_opname' => 6,
                'tanggal' => '2025-03-22',
                'keterangan' => 'Untuk cetak laporan',
                'id_bidang' => 6,
                'id_user' => 7,
                'status' => 'DITOLAK',
            ],
            [
                'nama_barang' => 'Spidol Marker',
                'jumlah' => 8,
                'satuan' => 'pcs',
                'id_stock_opname' => 7,
                'tanggal' => '2025-04-07',
                'keterangan' => 'Digunakan saat presentasi',
                'id_bidang' => 1,
                'id_user' => 8,
                'status' => 'ACC UMPEG',
            ],
            [
                'nama_barang' => 'Kertas HVS A4',
                'jumlah' => 40,
                'satuan' => 'rim',
                'id_stock_opname' => 8,
                'tanggal' => '2025-06-19',
                'keterangan' => 'Stok pengganti',
                'id_bidang' => 2,
                'id_user' => 9,
                'status' => 'ACC KABID',
            ],
            [
                'nama_barang' => 'Pensil HB',
                'jumlah' => 30,
                'satuan' => 'pcs',
                'id_stock_opname' => 9,
                'tanggal' => '2025-05-15',
                'keterangan' => 'Untuk dokumentasi manual',
                'id_bidang' => 3,
                'id_user' => 10,
                'status' => 'DITOLAK',
            ],
            [
                'nama_barang' => 'Penggaris Plastik',
                'jumlah' => 10,
                'satuan' => 'pcs',
                'id_stock_opname' => 10,
                'tanggal' => '2025-07-11',
                'keterangan' => 'Untuk pelengkap alat tulis',
                'id_bidang' => 4,
                'id_user' => 1,
                'status' => 'ACC PPTKSEKRETARIAT',
            ],
        ]);
    }
}
