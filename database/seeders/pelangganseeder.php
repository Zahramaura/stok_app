<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use faker\Factory as faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pelangganseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = faker::create();
        $data = [];

        for ($i=0; $i < 10; $i++) {
            $nama_suplier = 'PT. ' .$faker->company;
            $data[] = [
               'nama_suplier' => $nama_suplier,
               'alamat' => $faker->address,
               'telp' => $faker->numerify(
                $faker->randomelement([
                    '08##########',
                    '08###########',
                    '08############',
                ])),
                'email' => 'admin. ' . strtolower(str_replace(' ', '_', $nama_suplier)). '@gmail.com',
                'tgl_terdaftar' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'status' => 'Aktif'
            ];
        }

        DB::table('pelanggans')->insert($data);
    }
}
