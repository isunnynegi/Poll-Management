<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoteCast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public string $pollId
    ) {}

    public function broadcastOn(): array
    {
        return [
            new Channel('poll.' . $this->pollId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'vote.cast';
    }
}
