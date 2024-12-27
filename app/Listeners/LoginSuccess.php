<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Models\User;
use App\Events\LoginAt;
use Illuminate\Support\Facades\Auth;
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

        //give point to user  if  diffInDays >=1 after login
        if (Auth::check()) {
            $now = Carbon::now(); // date aujourd'hui
            $last_login = Auth::user()->last_login_at; // date de la derniere connexion
            $days =  $now->diffInDays($last_login); // nombre de jour  entre maintenant et la derniere connexion

            if ($days >= 1) {
                $event->user->increment('point', 20);
            }
        }
    }
}
