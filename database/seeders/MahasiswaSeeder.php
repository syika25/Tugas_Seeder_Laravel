<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $dosenList = DB::table('dosen')->pluck('nidn')->toArray();

        for ($i = 1; $i <= 15; $i++) {
            DB::table('mahasiswa')->insert([
                'npm' => $faker->unique()->numerify('##########'),
                'nidn' => $faker->randomElement($dosenList),
                'nama' => $faker->name(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
