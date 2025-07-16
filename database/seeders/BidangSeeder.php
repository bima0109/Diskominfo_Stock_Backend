<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidangs = [
            'IKP',
            'PDKI',
            'Sekretariat',
            'TIK',
            'EGov',
            'Statistik'
        ];

        foreach ($bidangs as $bidang) {
            DB::table('bidangs')->insert([
                'nama' => $bidang,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
