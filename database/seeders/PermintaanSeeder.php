<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;

class PermintaanSeeder extends Seeder
{
    public function run()
    {
        DB::table('permintaans')->insert([
            [
                'nama_barang' => 'Pulpen Standard',
                'jumlah' => 10,
                'satuan' => 'pcs',
                'kode_barang' => 1,
                'keterangan' => '-',
                'id_verifikasi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Buku Catatan',
                'jumlah' => 19,
                'satuan' => 'pcs',
                'kode_barang' => 2,
                'keterangan' => 'Kebutuhan rapat',
                'id_verifikasi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Kertas Fotokopi',
                'jumlah' => 20,
                'satuan' => 'rim',
                'kode_barang' => 3,
                'keterangan' => 'Untuk printer umum',
                'id_verifikasi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Stapler Kecil',
                'jumlah' => 10,
                'satuan' => 'pcs',
                'kode_barang' => 4,
                'keterangan' => 'Pengganti alat rusak',
                'id_verifikasi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Lem Kertas',
                'jumlah' => 5,
                'satuan' => 'pcs',
                'kode_barang' => 5,
                'keterangan' => 'Kebutuhan harian',
                'id_verifikasi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Kertas Warna A4',
                'jumlah' => 20,
                'satuan' => 'rim',
                'kode_barang' => 6,
                'keterangan' => 'Untuk cetak laporan',
                'id_verifikasi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Spidol Marker',
                'jumlah' => 8,
                'satuan' => 'pcs',
                'kode_barang' => 7,
                'keterangan' => 'Digunakan saat presentasi',
                'id_verifikasi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Kertas HVS A4',
                'jumlah' => 40,
                'satuan' => 'rim',
                'kode_barang' => 8,
                'keterangan' => 'Stok pengganti',
                'id_verifikasi' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Pensil HB',
                'jumlah' => 30,
                'satuan' => 'pcs',
                'kode_barang' => 9,
                'keterangan' => 'Untuk dokumentasi manual',
                'id_verifikasi' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Penggaris Plastik',
                'jumlah' => 10,
                'satuan' => 'pcs',
                'kode_barang' => 10,
                'keterangan' => 'Untuk pelengkap alat tulis',
                'id_verifikasi' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_barang' => 'Spidol Permanen',
                'jumlah' => 15,
                'satuan' => 'pcs',
                'kode_barang' => 11,
                'keterangan' => 'Untuk penandaan dokumen',
                'id_verifikasi' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
