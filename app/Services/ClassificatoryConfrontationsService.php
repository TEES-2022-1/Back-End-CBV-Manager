<?php

namespace App\Services;

use App\Models\ClassificatoryConfrontation;
use App\Models\League;
use Carbon\CarbonPeriod;
use Exception;
use http\Exception\RuntimeException;
use Illuminate\Database\Eloquent\Collection;

class ClassificatoryConfrontationsService
{
    public ClassificatoryConfrontation $classificatoryConfrontation;

    /**
     * @throws Exception
     */
    public function generateConfrontations(League $league)
    {
        $leagueTeams = $league->teams()->get();
        $rounds = $this->combineConfrontationTeams($leagueTeams);

        $period = CarbonPeriod::between($league->begin_in, $league->classificatory_limit)->toArray();
        if (count($period) < $this->calculateQuantityRounds($leagueTeams->count())) {
            throw new RuntimeException("Date range is insufficient for this operation.");
        }

        // Validar se os jogos da fase classificatória já foram criados para esta liga.

        /**
         * 11h
         * 13h
         * 17h
         */

        dd();

        return $this->classificatoryConfrontation::class;
    }

    private function combineConfrontationTeams(Collection $leagueTeams): array
    {
        $size = $leagueTeams->count();
        $quantityConfrontationsByRounds = $this->calculateQuantityConfrontationsByRounds($size);

        $combinations = [];
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
                if (count($rounds[$i]) < $quantityConfrontationsByRounds) {
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

        return $rounds;
    }



    private function calculateQuantityConfrontations(int $numberOfTeams): int
    {
        for ($i = $numberOfTeams - 1, $qtd = 0; $i > 0; $i--) $qtd += $i;
        return $qtd * 2;
    }

    private function calculateQuantityRounds(int $numberOfTeams): int
    {
        return $this->calculateQuantityConfrontations($numberOfTeams) / $this->calculateQuantityConfrontationsByRounds($numberOfTeams);
    }

    private function calculateQuantityConfrontationsByRounds(int $numberOfTeams): int
    {
        return $numberOfTeams/2;
    }
}
