<?php

namespace App\Listeners;

use App\Jobs\SendWelcomeEmail;
use Illuminate\Auth\Events\Verified;

class SendWelcomeEmailAfterVerification
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
    public function handle(Verified $event): void
    {
        // Dispatch the job to send the welcome email
        SendWelcomeEmail::dispatch($event->user);
    }
}
