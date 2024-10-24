<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::insert([
            ['id' => 1, 'nama' => 'Kelas 10A'],
            ['id' => 2, 'nama' => 'Kelas 10B'],
            ['id' => 3, 'nama' => 'Kelas 11A'],
            ['id' => 4, 'nama' => 'Kelas 11B'],
            ['id' => 5, 'nama' => 'Kelas 12A'],
            ['id' => 6, 'nama' => 'Kelas 12B'],
        ]);
    }
}
