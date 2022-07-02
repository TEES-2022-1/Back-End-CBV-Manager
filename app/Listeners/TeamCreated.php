<?php

namespace App\Listeners;

use App\Models\Classification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\TeamCreated as TeamCreatedEvent;

class TeamCreated
{
    /**
     * Handle the event.
     *
     * @param  TeamCreatedEvent  $event
     * @return void
     */
    public function handle(TeamCreatedEvent $event)
    {
        $team = $event->getTeam();
        $league = $team->league()->first();

        $classification = new Classification();
        $classification->team()->associate($team);
        $classification->league()->associate($league);
        $classification->save();
    }
}
