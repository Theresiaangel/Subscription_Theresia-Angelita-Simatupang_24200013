<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Keuangan; // Tambahkan ini di bagian atas

class Keuanganeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void // Kodingan Anda masuk di dalam fungsi run ini
    {
        Keuangan::updateOrCreate(
            ['keterangan' => 'Saldo Awal'],
            [
                'tanggal' => now(),
                'jenis' => 'pemasukan',
                'nominal' => 5000000
            ]
        );
    }
}