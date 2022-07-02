<?php

namespace App\Listeners;

use App\Models\Classification;
use App\Models\ClassificatoryConfrontation;
use App\Models\Confrontation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ConfrontationUpdated as ConfrontationUpdatedEvent;

class ConfrontationUpdated
{
    /**
     * Handle the event.
     *
     * @param  ConfrontationUpdatedEvent  $event
     * @return void
     */
    public function handle(ConfrontationUpdatedEvent $event)
    {
        $confrontation = $event->getModel();
        if ($confrontation->confrontable()->first() instanceof ClassificatoryConfrontation) {
            $teamHost = $confrontation->teamHost()->first();
            $classificationHost = $teamHost->clasification()->first();


            $teamGuest = $confrontation->teamGuest()->first();
            $classificationGuest = $teamGuest->clasification()->first();


        }
    }
}
