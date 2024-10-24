<?php

namespace App\Listeners;

use App\Events\IsRegistered;
use App\Mail\ForgotPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
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
    public function handle(IsRegistered $event): void
    {
        Mail::to($event->client->email)->send(new ForgotPasswordMail($event->client) );

    }
}
