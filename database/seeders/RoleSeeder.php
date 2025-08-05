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
            //1
            'SUPERADMIN',

            //admin bidang input permintaan 1
            //2
            'ADMIN',

            //acc terakhir
            //3
            'PPTKSEKRETARIAT',

            // kabid perbidang acc 1
            //4
            'KABID',

            // admin acc 2 
            //5
            'SEKRETARIS',
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
