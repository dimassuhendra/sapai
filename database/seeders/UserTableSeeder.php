<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    // database/seeders/UsersTableSeeder.php

    public function run(): void
    {
        // Akun Admin
        \App\Models\User::create([
            'username' => 'admin_bimbel',
            'email' => 'admin@bimbel.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'nama_lengkap' => 'Administrator Utama',
        ]);

        // Akun Guru
        \App\Models\User::create([
            'username' => 'guru_matematika',
            'email' => 'guru@bimbel.com',
            'password' => bcrypt('password123'),
            'role' => 'guru',
            'nama_lengkap' => 'Budi Sudarsono, S.Pd',
        ]);

        // Akun Pendaftar/Siswa
        \App\Models\User::create([
            'username' => 'siswa_teladan',
            'email' => 'siswa@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'pendaftar',
            'nama_lengkap' => 'Andi Wijaya',
        ]);
    }
}
