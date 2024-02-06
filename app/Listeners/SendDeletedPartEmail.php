<?php

namespace App\Listeners;

use App\Events\PartDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDeletedPartEmail
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
    public function handle(PartDeleted $event): void
    {
        logger('Sending email regarding part name ' . $event->part->name);
    }
}