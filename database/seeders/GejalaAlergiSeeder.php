<?php

namespace Database\Seeders;

use App\Models\Alergi;
use App\Models\GejalaAlergi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GejalaAlergiSeeder extends Seeder
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
                'id' => 'R1',
                'id_gejala' => ['G1', 'G2', 'G3', 'G4', 'G5', 'G6', 'G8', 'G9', 'G15', 'G22', 'G25'],
                'id_alergi' => 'P1'
            ], [
                'id' => 'R2',
                'id_gejala' => ['G2', "G3", 'G7', 'G8', 'G9'],
                'id_alergi' => 'P2'
            ], [
                'id' => 'R3',
                'id_gejala' => ['G10', 'G11', 'G12', 'G20'],
                'id_alergi' => 'P3'
            ], [
                'id' => 'R4',
                'id_gejala' => ['G1', 'G2', 'G3', 'G9', 'G13', 'G14', 'G17', 'G18', 'G20', 'G22', 'G24', 'G25'],
                'id_alergi' => 'P4'
            ], [
                'id' => 'R5',
                'id_gejala' => ['G2', 'G3', 'G4', 'G8', 'G16', 'G22'],
                'id_alergi' => 'P5'
            ], [
                'id' => 'R6',
                'id_gejala' => ['G2', 'G8', 'G10', 'G11', 'G20', 'G26', 'G22'],
                'id_alergi' => 'P6'
            ], [
                'id' => 'R7',
                'id_gejala' => ['G2', 'G4', 'G11', 'G23', 'G24', 'G26'],
                'id_alergi' => 'P7'
            ], [
                'id' => 'R8',
                'id_gejala' => ['G27', 'G2', 'G8', 'G11', 'G20'],
                'id_alergi' => 'P8'
            ]
        ];

        foreach ($data as $key => $value) {
            $value['id_gejala'] = json_encode($value['id_gejala']);
            GejalaAlergi::create($value);
        }
    }
}
