<?php

namespace App\Listeners;

use App\Events\Chat\SendMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerSendMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendMessage  $event
     * @return void
     */
    public function handle(SendMessage $event)
    {
        //
    }
}
