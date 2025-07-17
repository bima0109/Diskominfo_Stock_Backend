<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            //rekap+tambah data
            'SUPERADMIN',

            //admin bidang input permintaan 1
            'ADMIN_IKP',
            'ADMIN_PDKI',
            'ADMIN_STATISTIK',
            'ADMIN_EGOV',
            'ADMIN_TIK',
            'ADMIN_SEKRETARIAT',

            //acc terakhir
            'PPTKSEKRETARIAT',

            // kabid perbidang acc 2
            'KABID_IKP',
            'KABID_TIK',
            'KABID_STATISTIK',
            'KABID_PDKI',
            'KABID_EGOV',
            // super admin acc 3 
            'UMPEG',
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'nama' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
