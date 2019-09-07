<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class PreventRegisterRedirect
{
    /**
     * Handle the event.
     *
     * Prevent the redirection after a
     * successfull registration.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        abort(200);
    }
}
