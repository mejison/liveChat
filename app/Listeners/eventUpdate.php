<?php

namespace App\Listeners;

use App\Events\addMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class eventUpdate
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
     * @param  addMessage  $event
     * @return void
     */
    public function handle(addMessage $event)
    {
        //
    }
}
