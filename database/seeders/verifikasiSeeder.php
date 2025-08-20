<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class verifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('verifikasis')->insert([
            [
                'tanggal' => now(),
                'status' => 'ACC KABID',
                'id_user' => 2,
                'id_bidang' => 1,
                'menyetujui' => '-',
                'tanggal_acc' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => '2024-07-24',
                'status' => 'ACC SEKRETARIS',
                'id_user' => 3,
                'id_bidang' => 2,
                'menyetujui' => '-',
                'tanggal_acc' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => '2025-04-24',
                'status' => 'ACC PPTK SEKRETARIAT',
                'id_user' => 4,
                'id_bidang' => 6,
                'menyetujui' => 'Hotman Paris',
                'tanggal_acc' => '2025-04-28',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
