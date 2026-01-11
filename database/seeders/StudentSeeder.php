<?php

namespace Database\Seeders;

use App\Models\PesertaUjian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PesertaUjian::create([
            'nama_lengkap' => 'Budiono Siregar',
            'nomor_ujian' => 'SD-' . now()->format('Y') . '-' . strtoupper(Str::random(6)),
        ]);
    }
}
