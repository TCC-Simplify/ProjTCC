<?php

namespace App\Events\Chat;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Menssage;

class EqSendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $equipeNotification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Menssage $message, int $equipeNotification)
    {
        $this->message = $message;
        $this->equipeNotification = $equipeNotification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('equipe.'.$this->equipeNotification);
    }

    public function broadcastAs()
    {
        return 'SendMessage';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message
        ];
    }
}
