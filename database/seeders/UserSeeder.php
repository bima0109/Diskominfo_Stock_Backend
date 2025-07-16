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
                'nama' => 'Budi Setiawan',
                'email' => 'superadmin@example.com',
                'id_role' => 1,
                'id_bidang' => 1,
            ],
            [
                'nama' => 'Joko Widodo',
                'email' => 'admin.ikp@example.com',
                'id_role' => 2,
                'id_bidang' => 1,
            ],
            [
                'nama' => 'Gina Pratiwi',
                'email' => 'admin.pdki@example.com',
                'id_role' => 3,
                'id_bidang' => 2,
            ],
            [
                'nama' => 'Tria Kusuma',
                'email' => 'admin.statistik@example.com',
                'id_role' => 4,
                'id_bidang' => 6,
            ],
            [
                'nama' => 'Wati Sari',
                'email' => 'admin.egov@example.com',
                'id_role' => 5,
                'id_bidang' => 5,
            ],
            [
                'nama' => 'Asep Hidayat',
                'email' => 'admin.tik@example.com',
                'id_role' => 6,
                'id_bidang' => 4,
            ],
            [
                'nama' => 'Citra Lestari',
                'email' => 'admin.sekretariat@example.com',
                'id_role' => 7,
                'id_bidang' => 3,
            ],
            [
                'nama' => 'Gilang Prabowo',
                'email' => 'umpeg@example.com',
                'id_role' => 8,
                'id_bidang' => 3,
            ],
            [
                'nama' => 'Layla Salsabila',
                'email' => 'pptksekretaris@example.com',
                'id_role' => 9,
                'id_bidang' => 3,
            ],
            [
                'nama' => 'Zainal Abidin',
                'email' => 'kabid.ikp@example.com',
                'id_role' => 10,
                'id_bidang' => 1,
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'nama' => $user['nama'],
                'email' => $user['email'],
                'password' => Hash::make('password123'),
                'id_role' => $user['id_role'],
                'id_bidang' => $user['id_bidang'],
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
