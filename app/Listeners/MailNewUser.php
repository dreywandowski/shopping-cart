<?php

namespace App\Listeners;

use App\Events\NewUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class MailNewUser
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
     * @param  New User  $event
     * @return void
     */
    public function handle(NewUser $event)
    {
        $users = User::all();

        foreach($users as $user) {
           Mail::to($user)->send('/shopping-cart/mail-test', $event->user);
        }
}

}
