<?php

namespace App\Listeners;

use App\Events\Chat\EqSendMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerEqSendMessage
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
     * @param  EqSendMessage  $event
     * @return void
     */
    public function handle(EqSendMessage $event)
    {
        //
    }
}
