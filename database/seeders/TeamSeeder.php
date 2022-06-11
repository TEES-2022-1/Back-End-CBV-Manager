<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'name' => 'Sada Cruzeiro Vôlei',
                'year_foundation' => 2006,
                'gymnasium' => 'Poliesportivo do Riacho',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
        ];

        \App\Models\Team::insert($teams);
    }
}
