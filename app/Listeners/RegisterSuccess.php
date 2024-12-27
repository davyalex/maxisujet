<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Events\NewRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterSuccess
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
    public function handle(NewRegister $event): void
    {
        //
        $event->user->update([
            'last_login_at' => Carbon::now(),
            'last_login_ip_address' => request()->ip()
        ]);

        //give point to user  if to first login or new register
        if (Auth::check()) {
            $event->user->increment('point', 20);
            
        }
    }
}
