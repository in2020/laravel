<?php

namespace App\Listeners;

use App\Events\Event;
use App\Jobs\SendEmail;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class EventListener
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
     * @param  Event  $event
     * @return void
     */
    public function handle(Event $event)
    {
        Log::info('event listener');
//        SendEmail::dispatch(User::first());
        SendEmail::dispatch(User::first())->delay(now()->addMinutes(1));

    }
}
