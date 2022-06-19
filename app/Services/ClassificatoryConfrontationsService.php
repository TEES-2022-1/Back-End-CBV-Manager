<?php

namespace App\Services;

use App\Models\ClassificatoryConfrontation;
use App\Models\League;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Support\Collection;

class ClassificatoryConfrontationsService
{
    private static int $minimumDaysBetweenRounds = 3;

    /**
     * @throws Exception
     */
    public function generateConfrontations(League $league)
    {
        dump($league->classificatoryConfrontations()->count());

        $leagueTeams = $league->teams()->get();
        $combinations = $this->generateCombinations($leagueTeams);
        $rounds = $this->generateRounds($combinations);

        dd($combinations, $rounds);

        $period = CarbonPeriod::between($league->begin_in, $league->classificatory_limit);
        $daysBetweenRounds = floor($period->count() / $this->calculateQuantityRounds($leagueTeams->count()));

        if (self::$minimumDaysBetweenRounds > $daysBetweenRounds) {
            throw new Exception("Date range is insufficient to generate the classificatory confrontations.");
        }

        for ($round = 0, $date = $period->first();
             $round < $this->calculateQuantityRounds($leagueTeams->count()) && $date->isBefore($period->last());
             $round++, $date->addDays($daysBetweenRounds)) {

            $date->setHours(8);
            dump($date->toDateTimeString());
        }

        dd($combinations);
    }

    private function generateCombinations(Collection $leagueTeams): Collection
    {
        $size = $leagueTeams->count();
        $quantityRounds = $this->calculateQuantityRounds($size)/2;
        $quantityConfrontationsByRounds = $this->calculateQuantityConfrontationsByRounds($size);

        $combinations = [];
        for ($i = 0; $i < $size; $i++) {
            $teamA = $leagueTeams->get($i)->id;
            for ($j = $i+1; $j < $size; $j++) {
                $teamB = $leagueTeams->get($j)->id;
                $combinations[] = compact('teamA', 'teamB');
            }
        }

        $rounds = array_fill(0, $quantityRounds, []);
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

        return collect($rounds);
    }

    private function generateRounds(Collection $combinations): Collection
    {
        $originalSize = $combinations->count();
        for ($i = 0; $i < $originalSize; $i++) {
            $combination = $combinations->get($i);
            dump($combination);
        }

        return $combinations;
    }


    private function calculateQuantityRounds(int $numberOfTeams): int
    {
        return $this->calculateQuantityConfrontations($numberOfTeams) / $this->calculateQuantityConfrontationsByRounds($numberOfTeams);
    }

    private function calculateQuantityConfrontations(int $numberOfTeams): int
    {
        for ($i = $numberOfTeams - 1, $qtd = 0; $i > 0; $i--) $qtd += $i;
        return $qtd * 2;
    }

    private function calculateQuantityConfrontationsByRounds(int $numberOfTeams): int
    {
        return $numberOfTeams/2;
    }
}
