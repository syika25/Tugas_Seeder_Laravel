<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $matkul=['Matematika', 'Fisika', 'Kimia', 'Biologi', 'Pemrograman', 'Basis Data'];

        for ($i = 1; $i <= 6; $i++) {
            DB::table('matakuliah')->insert([
                'kode_matakuliah' => 'MK' . $faker->unique()->numerify('######'),
                'nama_matakuliah' => $faker->randomElement($matkul),
                'sks' => $faker->randomElement([2, 3, 4]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
