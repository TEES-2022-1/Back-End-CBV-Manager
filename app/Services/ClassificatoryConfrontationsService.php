<?php

namespace App\Services;

use App\Models\ClassificatoryConfrontation;
use App\Models\League;

class ClassificatoryConfrontationsService
{
    public ClassificatoryConfrontation $classificatoryConfrontation;

    public function generateConfrontations(League $league)
    {
        $leagueTeams = $league->teams()->get();

        $combinations = [];
        $size = $leagueTeams->count();
        for ($i = 0; $i < $size; $i++) {
            $teamA = $leagueTeams->get($i)->name;
            for ($j = $i+1; $j < $size; $j++) {
                $teamB = $leagueTeams->get($j)->name;
                $combinations[$teamA][] = $teamB;
//                $combinations[$teamB][] = $teamA;
            }
        }

        dd($combinations);

        return $this->classificatoryConfrontation::class;
    }
}
