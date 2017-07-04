<?php

namespace App\Listeners;

use App\Events\SendActivationToken;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;
use App\Mail\SendActivationTokenEmail;

class SendActivationEmail
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
     * @param  SendActivationToken  $event
     * @return void
     */
    public function handle(SendActivationToken $event)
    {
        //Build URL.
        $url = route('verify.email', ['token' => $event->token ] );

        Mail::to($event->user->email)
              ->send(new SendActivationTokenEmail($event->user, $url));
    }
}
