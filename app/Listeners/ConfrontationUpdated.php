<?php

namespace App\Listeners;

use App\Events\ConfrontationUpdated as ConfrontationUpdatedEvent;
use App\Models\ClassificatoryConfrontation;
use Illuminate\Support\Facades\DB;

class ConfrontationUpdated
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(ConfrontationUpdatedEvent $event)
    {
        $confrontation = $event->getModel();
        if (!($confrontation->confrontable()->first() instanceof ClassificatoryConfrontation)) {
            return;
        }

        $previous = $event->getPrevious();
        $current = $event->getCurrent();
        if (empty($current['result_host']) || empty($current['result_guest'])) {
            return;
        }

        $teamHost = $confrontation->teamHost()->first();
        $teamGuest = $confrontation->teamGuest()->first();

        $classificationHost = $teamHost->classification()->first();
        $classificationGuest = $teamGuest->classification()->first();

        DB::transaction(function () use ($classificationHost, $classificationGuest, $previous, $current) {
            $this->updateClassification($classificationHost, $previous, $current);
            $this->updateClassification($classificationGuest, $previous, $current, false);
        });
    }

    private function updateClassification($classification, $previous, $current, $host = true)
    {
        if (!empty($previous['result_host']) && !empty($previous['result_guest'])) {
            $resultsPrevious = $this->calculateResults($previous, $host);
            foreach (array_keys($resultsPrevious) as $key) {
                $classification[$key] -= $resultsPrevious[$key];
            }
        }

        $resultsCurrent = $this->calculateResults($current, $host);
        foreach (array_keys($resultsCurrent) as $key) {
            $classification[$key] += $resultsCurrent[$key];
        }

        $classification->save();
    }

    private function calculateResults($confrontation, $host): array
    {
        $results = [
            'confrontations_win' => 0,
            'confrontations_loss' => 0,
            'sets_win' => 0,
            'sets_loss' => 0,
            'points_win' => 0,
            'points_loss' => 0,
            'results_3_0' => 0,
            'results_3_1' => 0,
            'results_3_2' => 0,
            'results_0_3' => 0,
            'results_1_3' => 0,
            'results_2_3' => 0,
        ];

        foreach (range(1, 5) as $n) {
            $set_points_host = $confrontation["set{$n}_points_host"];
            $set_points_guest = $confrontation["set{$n}_points_guest"];

            if (empty($set_points_host) && empty($set_points_guest)) {
                continue;
            }

            if ($host) {
                $results['points_win'] += $set_points_host;
                $results['points_loss'] += $set_points_guest;

                if ($set_points_host > $set_points_guest) {
                    $results['sets_win']++;
                } else {
                    $results['sets_loss']++;
                }
            } else {
                $results['points_win'] += $set_points_guest;
                $results['points_loss'] += $set_points_host;

                if ($set_points_guest > $set_points_host) {
                    $results['sets_win']++;
                } else {
                    $results['sets_loss']++;
                }
            }
        }

        $results["results_{$results['sets_win']}_{$results['sets_loss']}"]++;

        if ($results['sets_win'] > $results['sets_loss']) {
            $results["confrontations_win"]++;
        } else {
            $results["confrontations_loss"]++;
        }

        return $results;
    }
}
