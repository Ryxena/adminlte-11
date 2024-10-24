<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::insert([
            [
                'id' => 1,
                'nama' => 'Ryxena',
                'nis' => '123456',
                'tanggal_lahir' => Carbon::createFromFormat('Y-m-d', '2005-01-15'),
                'kelas_id' => 1,
            ],
            [
                'id' => 2,
                'nama' => 'Aulia',
                'nis' => '123457',
                'tanggal_lahir' => Carbon::createFromFormat('Y-m-d', '2005-02-20'),
                'kelas_id' => 1,
            ],
            [
                'id' => 3,
                'nama' => 'Budi',
                'nis' => '123458',
                'tanggal_lahir' => Carbon::createFromFormat('Y-m-d', '2005-03-10'),
                'kelas_id' => 2,
            ],
            [
                'id' => 4,
                'nama' => 'Citra',
                'nis' => '123459',
                'tanggal_lahir' => Carbon::createFromFormat('Y-m-d', '2005-04-05'),
                'kelas_id' => 2,
            ],
            [
                'id' => 5,
                'nama' => 'Dina',
                'nis' => '123460',
                'tanggal_lahir' => Carbon::createFromFormat('Y-m-d', '2005-05-15'),
                'kelas_id' => 3,
            ],            [
                'id' => 6,
                'nama' => 'Dio',
                'nis' => '555555',
                'tanggal_lahir' => Carbon::createFromFormat('Y-m-d', '2005-05-15'),
                'kelas_id' => null,
            ],            [
                'id' => 7,
                'nama' => 'Jojo',
                'nis' => '777777',
                'tanggal_lahir' => Carbon::createFromFormat('Y-m-d', '2005-05-15'),
                'kelas_id' => null,
            ],
        ]);
    }
}
