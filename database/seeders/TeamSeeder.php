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
                'name' => 'Minas',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
            [
                'name' => 'Guarulhos',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
            [
                'name' => 'São José dos Campos',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
            [
                'name' => 'Campinas',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
            [
                'name' => 'Montes Claros',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
            [
                'name' => 'Natal',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
            [
                'name' => 'Brasília',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
            [
                'name' => 'Sesi',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
            [
                'name' => 'Cruzeiro',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
            [
                'name' => 'Goiás',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
            [
                'name' => 'Uberlândia',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
            [
                'name' => 'Blumenau',
                'year_foundation' => 9999,
                'gymnasium' => 'Poliesportivo',
                'category' => 'MALE',
                'affiliated_federation_in' => '2022-01-01',
                'league_id' => 1,
            ],
        ];

        \App\Models\Team::insert($teams);
    }
}
