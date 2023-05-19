<?php

namespace Database\Seeders;

use App\Models\Alergi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlergiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 'P1',
                'nama_alergi' => 'Alergi makanan mengandung telur'
            ], [
                'id' => 'P2',
                'nama_alergi' => 'Alergi pada kulit'
            ], [
                'id' => 'P3',
                'nama_alergi' => 'Alergi debu'
            ], [
                'id' => 'P4',
                'nama_alergi' => 'Alergi obat'
            ], [
                'id' => 'P5',
                'nama_alergi' => 'Alergi serangga'
            ], [
                'id' => 'P6',
                'nama_alergi' => 'Alergi jamur pada ruangan lembab'
            ], [
                'id' => 'P7',
                'nama_alergi' => 'Alergi serbuk sari'
            ], [
                'id' => 'P8',
                'nama_alergi' => 'Alergi rumput'
            ]
        ];

        foreach ($data as $key => $value) {
            Alergi::create($value);
        }
    }
}
