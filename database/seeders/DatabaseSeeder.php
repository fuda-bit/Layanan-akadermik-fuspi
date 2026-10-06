<?php
namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Application::firstOrCreate(['reference' => 'FUSPI-CONTOH-001'], [
            'service_type' => 'aktif', 'student_name' => 'Mahasiswa Contoh',
            'student_number' => '222000000', 'study_program' => 'Ilmu Perpustakaan dan Informasi Islam',
            'email' => 'mahasiswa@example.com', 'destination' => 'Instansi Tujuan',
            'purpose' => 'Contoh keperluan pengujian aplikasi', 'access_token' => Str::random(48),
        ]);
    }
}
