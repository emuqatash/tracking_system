<?php

namespace App\Listeners;

class SetAccountIdInSession
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
//        if ($event->user->id !== 1) {
        session()->put('account_id', $event->user->account_id);
//        }
    }
}
