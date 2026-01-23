<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Program::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $programs = [
            [
                'nama_program' => 'Program CALISTUNG',
                'deskripsi' => 'Program untuk anak TK agar dapat membaca, menulis, & menghitung sebagai fondasi pendidikan dasar.',
                'harga' => 250000,
                'durasi' => '3 Bulan',
                'thumbnail' => 'assets/img/programs/calistung.jpg',
            ],
            [
                'nama_program' => 'Program SD',
                'deskripsi' => 'Bimbingan belajar untuk siswa kelas 1-6 SD semua mata pelajaran utama untuk meningkatkan nilai rapor.',
                'harga' => 300000,
                'durasi' => '6 Bulan',
                'thumbnail' => 'assets/img/programs/sd.jpg',
            ],
            [
                'nama_program' => 'Program SMP',
                'deskripsi' => 'Bimbingan intensif untuk siswa kelas 1-3 SMP agar unggul di sekolah dan siap masuk SMA favorit.',
                'harga' => 400000,
                'durasi' => '6 Bulan',
                'thumbnail' => 'assets/img/programs/smp.jpg',
            ],
            [
                'nama_program' => 'Program SMA',
                'deskripsi' => 'Persiapan komprehensif untuk siswa kelas 1-3 SMA jurusan IPA dan IPS menghadapi ujian sekolah.',
                'harga' => 500000,
                'durasi' => '1 Tahun',
                'thumbnail' => 'assets/img/programs/sma.jpg',
            ],
            [
                'nama_program' => 'Program UTBK/UM',
                'deskripsi' => 'Bimbingan intensif dan strategis untuk menghadapi UTBK-SNBT dan Ujian Mandiri PTN Favorit.',
                'harga' => 700000,
                'durasi' => '4 Bulan',
                'thumbnail' => 'assets/img/programs/utbk.jpg',
            ],
            [
                'nama_program' => 'Program CPNS',
                'deskripsi' => 'Persiapan lengkap menghadapi seluruh tahapan seleksi CPNS (SKD, SKB, dan Wawancara).',
                'harga' => 1500000,
                'durasi' => '3 Bulan',
                'thumbnail' => 'assets/img/programs/cpns.jpg',
            ],
            [
                'nama_program' => 'Les Privat',
                'deskripsi' => 'Bimbingan personal satu-satu yang disesuaikan dengan kebutuhan dan jadwal fleksibel siswa.',
                'harga' => 500000,
                'durasi' => 'Per Sesi',
                'thumbnail' => 'assets/img/programs/privat.jpg',
            ],
            [
                'nama_program' => 'Tembus SIMAK UI/UGM',
                'deskripsi' => 'Strategi khusus taklukkan ujian mandiri universitas terbaik dengan bedah soal khas UI dan UGM.',
                'harga' => 1000000,
                'durasi' => '3 Bulan',
                'thumbnail' => 'assets/img/programs/simak.jpg',
            ],
            [
                'nama_program' => 'Sekolah Kedinasan',
                'deskripsi' => 'Bimbingan lengkap dari tes tulis (SKD), psikotes, hingga persiapan tes fisik (Kesamaptaan).',
                'harga' => 1000000,
                'durasi' => '5 Bulan',
                'thumbnail' => 'assets/img/programs/kedinasan.jpg',
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}