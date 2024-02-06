<?php

namespace App\Listeners;

class ClearTenantId
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
        session()->forget('account_id', $event->user->tenant_id);
    }
}
