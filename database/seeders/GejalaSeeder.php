<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
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
                'id' => 'G1',
                'gejala' => 'Mulut terasa gatal'
            ], [
                'id' => 'G2',
                'gejala' => 'Kulit terasa gatal'
            ], [
                'id' => 'G3',
                'gejala' => 'Ada pembengkakan di bibir'
            ], [
                'id' => 'G4',
                'gejala' => 'Pusing'
            ], [
                'id' => 'G5',
                'gejala' => 'Mual'
            ], [
                'id' => 'G6',
                'gejala' => 'Muntah'
            ], [
                'id' => 'G7',
                'gejala' => 'Ada pembengkakan di kulit'
            ], [
                'id' => 'G8',
                'gejala' => 'Kulit memerah'
            ], [
                'id' => 'G9',
                'gejala' => 'Muncul ruam di kulit'
            ], [
                'id' => 'G10',
                'gejala' => 'Bersin yang berulang'
            ], [
                'id' => 'G11',
                'gejala' => 'Hidung berair'
            ], [
                'id' => 'G12',
                'gejala' => 'Hidung, langit-langit mulut, atau tenggorokan terasa gatal'
            ], [
                'id' => 'G13',
                'gejala' => 'Telah meminum antibiotik'
            ], [
                'id' => 'G14',
                'gejala' => 'Telah meminum obat tertentu'
            ], [
                'id' => 'G15',
                'gejala' => 'Telah mengkonsumsi produk yang mengandung susu/telur'
            ], [
                'id' => 'G16',
                'gejala' => 'Pembengkakan ringan di sekitar gigitan'
            ], [
                'id' => 'G17',
                'gejala' => 'Pingsan'
            ], [
                'id' => 'G18',
                'gejala' => 'Sakit Perut'
            ], [
                'id' => 'G19',
                'gejala' => 'Demam'
            ], [
                'id' => 'G20',
                'gejala' => 'Gatal pada hidung, mata, dan atau tenggorokan'
            ], [
                'id' => 'G21',
                'gejala' => 'Telah memakan jamur makanan'
            ], [
                'id' => 'G22',
                'gejala' => 'Sesak napas'
            ], [
                'id' => "G23",
                'gejala' => "Mata berair dan merah"
            ], [
                'id' => 'G24',
                'gejala' => 'Pembengkakan di sekitar mata'
            ], [
                'id' => 'G25',
                'gejala' => 'Pembengkakan di wajah'
            ], [
                'id' => 'G26',
                'gejala' => 'Hidung tersumbat'
            ], [
                'id' => 'G27',
                'gejala' => 'Telah beraktivitas di temapat yang memiliki rumput'
            ]
        ];

        foreach ($data as $key => $value) {
            Gejala::create($value);
        }
    }
}
