<?php

namespace App\Services;

use App\Models\ClassificatoryConfrontation;
use App\Models\Confrontation;
use App\Models\League;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ClassificatoryConfrontationsService
{
    private static int $minimumDaysBetweenRounds = 3;
    private static int $quantityTeams = 12;

    /**
     * @throws Exception
     */
    public function generateConfrontations(League $league)
    {
        $leagueTeams = $league->teams()->get();

        if ($leagueTeams->count() != self::$quantityTeams) {
            throw new Exception('Unable to generate confrontations. The quantity teams is invalid.');
        }
        if ($league->classificatoryConfrontations()->count() > 0) {
            throw new Exception('Unable to generate confrontations. Confrontations have already been generated.');
        }

        $roundCombinations = $this->generateRoundCombinations($leagueTeams);
        $this->createRounds($league, $roundCombinations, $leagueTeams->count());
    }

    private function generateRoundCombinations(Collection $leagueTeams): Collection
    {
        $size = $leagueTeams->count();
        $quantityRounds = $this->calculateQuantityRounds($size)/2;
        $quantityConfrontationsByRounds = $this->calculateQuantityConfrontationsByRounds($size);

        $combinations = [];
        for ($i = 0; $i < $size; $i++) {
            $teamA = $leagueTeams->get($i);
            for ($j = $i+1; $j < $size; $j++) {
                $teamB = $leagueTeams->get($j);
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

        for ($i = 0; $i < $quantityRounds; $i++) {
            $returnRound = [];
            for ($j = 0; $j < count($rounds[$i]); $j++) {
                $returnRound[] = [
                    'teamA' => $rounds[$i][$j]['teamB'],
                    'teamB' => $rounds[$i][$j]['teamA'],
                ];
            }

            $rounds[] = $returnRound;
        }

        return collect($rounds);
    }

    /**
     * @throws Exception
     */
    private function createRounds(League $league, Collection $roundCombinations, int $quantityTeams)
    {
        $period = CarbonPeriod::between($league->begin_in, $league->classificatory_limit);
        $quantityRounds = $this->calculateQuantityRounds($quantityTeams);
        $daysBetweenRounds = floor($period->count() / $quantityRounds);

        if (self::$minimumDaysBetweenRounds > $daysBetweenRounds) {
            throw new Exception("Date range is insufficient to generate the classificatory confrontations.");
        }

        DB::transaction(function() use($period, $league, $roundCombinations, $daysBetweenRounds, $quantityRounds) {
            for ($round = 1, $scheduling = $period->first();
                 $round <= $quantityRounds && $scheduling->isBefore($period->last());
                 $round++, $scheduling->addDays($daysBetweenRounds)) {
                $scheduling->setHours(8);
                $combinations = $roundCombinations->shift();

                foreach ($combinations as $combination) {
                    $classificatoryConfrontation = new ClassificatoryConfrontation(compact('round'));
                    $classificatoryConfrontation->save();

                    $confrontation = new Confrontation(compact('scheduling'));
                    $confrontation->league()->associate($league);
                    $confrontation->teamHost()->associate($combination['teamA']);
                    $confrontation->teamGuest()->associate($combination['teamB']);
                    $confrontation->confrontable()->associate($classificatoryConfrontation);
                    $confrontation->save();

                    $scheduling->addHours(2);
                }
            }
        });

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
