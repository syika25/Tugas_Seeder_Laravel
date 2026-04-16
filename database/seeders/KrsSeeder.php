<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $npmList = DB::table('mahasiswa')->pluck('npm')->toArray();
        $matkulList = DB::table('matakuliah')->pluck('kode_matakuliah')->toArray();

        for ($i = 1; $i <= 30; $i++) {
            DB::table('krs')->insert([
                'npm' => $faker->randomElement($npmList),
                'kode_matakuliah' => $faker->randomElement($matkulList),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
