<?php

namespace App\Events;

use App\Models\Confrontation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConfrontationUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Confrontation $model;
    private array $current;
    private array $previous;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Confrontation $confrontation)
    {
        $this->model = $confrontation;
        $this->current = $confrontation->getAttributes();
        $this->previous = $confrontation->getOriginal();
    }

    public function getModel(): Confrontation
    {
        return $this->model;
    }

    public function getPrevious(): array
    {
        return $this->previous;
    }

    public function getCurrent(): array
    {
        return $this->current;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
