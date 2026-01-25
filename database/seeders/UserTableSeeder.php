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
            'username' => 'admin_sapai',
            'email' => 'admin@sapai.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'nama_lengkap' => 'Administrator Utama',
        ]);

        // Akun Guru
        \App\Models\User::create([
            'username' => 'guru_matematika',
            'email' => 'guru@sapai.com',
            'password' => bcrypt('12345678'),
            'role' => 'guru',
            'nama_lengkap' => 'Budi Sudarsono, S.Pd',
        ]);

        // Akun Pendaftar/Siswa
        \App\Models\User::create([
            'username' => 'siswa_teladan',
            'email' => 'siswa@sapai.com',
            'password' => bcrypt('12345678'),
            'role' => 'pendaftar',
            'nama_lengkap' => 'Andi Wijaya',
        ]);
    }
}
