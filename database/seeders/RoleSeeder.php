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
            'SUPERADMIN',
            'ADMIN_IKP',
            'ADMIN_PDKI',
            'ADMIN_STATISTIK',
            'ADMIN_EGOV',
            'ADMIN_TIK',
            'ADMIN_SEKRETARIAT',
            'UMPEG',
            'PPTKSEKRETARIS',
            'KABID_IKP',
            'KABID_TIK',
            'KABID_STATISTIK',
            'KABID_SEKRETARIAT',
            'KABID_PDKI',
            'KABID_EGOV'
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
