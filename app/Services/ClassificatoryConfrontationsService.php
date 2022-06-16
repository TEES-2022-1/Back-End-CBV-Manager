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
            $teamA = $leagueTeams->get($i)->id;
            for ($j = $i+1; $j < $size; $j++) {
                $teamB = $leagueTeams->get($j)->id;
                $combinations[] = compact('teamA', 'teamB');
            }
        }

        $rounds = array_fill(0, $size - 1, []);
        $i = 0;
        foreach ($combinations as $index => $combination) {
            $allocated = false;
            do {
                if (count($rounds[$i]) < $size/2) {
                    for ($j = 0, $found = false; $j < count($rounds[$i]) && !$found; $j++) {
                        if ($rounds[$i][$j]['teamA'] == $combination['teamA']
                            || $rounds[$i][$j]['teamB'] == $combination['teamA']
                            || $rounds[$i][$j]['teamA'] == $combination['teamB']
                            || $rounds[$i][$j]['teamB'] == $combination['teamB']) {
                            $found = true;
                        }
                    }

                    if (!$found) {
                        $rounds[$i][] = $combination;
                        unset($combinations[$index]);
                        $allocated = true;
                    }
                }
                $i = (++$i < count($rounds)) ? $i : 0;
            } while(!$allocated);
        }

        dd($rounds);

        return $this->classificatoryConfrontation::class;
    }
}
