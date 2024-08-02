<?php

namespace App\Listeners;

use App\Events\RegisterProcessed;
use App\Jobs\RegisterMailJob;

class SendRegisterNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(RegisterProcessed $event): void
    {
        RegisterMailJob::dispatch($event->email, $event->name);
    }
}
