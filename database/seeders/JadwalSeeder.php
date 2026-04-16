<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $nidnList = DB::table('dosen')->pluck('nidn')->toArray();
        $matkulList = DB::table('matakuliah')->pluck('kode_matakuliah')->toArray();
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $kelas = ['A', 'B', 'C', 'D'];

        for ($i = 1; $i <= 10; $i++) {
            DB::table('jadwal')->insert([
                'kode_matakuliah' => $faker->randomElement($matkulList),
                'nidn' => $faker->randomElement($nidnList),
                'kelas' => $faker->randomElement($kelas),
                'hari' => $faker->randomElement($hari),
                'jam' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
