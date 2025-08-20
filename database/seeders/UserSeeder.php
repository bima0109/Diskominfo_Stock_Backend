<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Lulut',
                'username' => 'adminSuperman',
                'id_role' => 1,
                'id_bidang' => 3,
                'role' => 'SUPERADMIN',
            ],
            [
                'nama' => 'Oriza',
                'username' => 'admin.ikp',
                'id_role' => 2,
                'id_bidang' => 1,
                'role' => 'ADMIN',
            ],
            [
                'nama' => 'Galih',
                'username' => 'Sekretaris',
                'id_role' => 5,
                'id_bidang' => 3,
                'role' => 'SEKRETARIS',
            ],
            [
                'nama' => 'Tria Kusuma',
                'username' => 'admin.statistik',
                'id_role' => 2,
                'role' => 'ADMIN',
                'id_bidang' => 6,
            ],
            [
                'nama' => 'Wati Sari',
                'username' => 'admin.egov',
                'id_role' => 2,
                'id_bidang' => 5,
                'role' => 'ADMIN',
            ],
            [
                'nama' => 'Asep Hidayat',
                'username' => 'admin.tik',
                'id_role' => 2,
                'role' => 'ADMIN',
                'id_bidang' => 4,
            ],
            [
                'nama' => 'Citra Lestari',
                'username' => 'admin.sekretariat',
                'id_role' => 2,
                'id_bidang' => 3,
                'role' => 'ADMIN',
            ],
            [
                'nama' => 'Gilang Prabowo',
                'username' => 'pptkSekre',
                'id_role' => 3,
                'id_bidang' => 3,
                'role' => 'PPTK SEKRETARIAT',
            ],
            [
                'nama' => 'Layla Salsabila',
                'username' => 'kabid.ikp',
                'id_role' => 4,
                'id_bidang' => 3,
                'role' => 'KABID',
            ],
            [
                'nama' => 'Zainal Abidin',
                'username' => 'kabid.tik',
                'id_role' => 4,
                'id_bidang' => 1,
                'role' => 'KABID',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'nama' => $user['nama'],
                'username' => $user['username'],
                'password' => Hash::make('password123'),
                'id_role' => $user['id_role'],
                'id_bidang' => $user['id_bidang'],
                'role' => $user['role'],
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
