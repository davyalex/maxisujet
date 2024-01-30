<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Events\LoginAt;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginSuccess
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
    public function handle(LoginAt $event): void
    {
        //
        $event->user->update([
            'last_login_at' => Carbon::now(),
            'last_login_ip_address' => request()->ip()
        ]);
    }
}
