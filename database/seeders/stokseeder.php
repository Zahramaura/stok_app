<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Container\Attributes\DB;

class stokseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker =Faker::create();
        $data = [];

        $areas = [
            'palembang' => 'PLG',
            'bandung' => 'BDG',
            'yogyakarta' => 'DIY',
            'papua' => 'PPA',
            'medan' => 'MDN',
            'pekan baru' => 'PBRU',
        ];

        for ($i=0; $i < 20 ; $i++) {

            $andomArea = $faker->randomElement($areas);
            $data[] = [
             'kode_barang' => strtoupper($faker->lexify('???').$faker->unique()->numerify('####')),
             'nama_barang' => $faker->words(10, true),
            'harga' => $faker->numberBetween(10000, 500000),
             'stok' => $faker->numberBetween(50, 100),
            'suplier_id' => $faker->numberBetween(1, 2),
            'cabang' => $randomArea,
            ];
        }

        DB::table('stoks')->insert($data);
    }
}