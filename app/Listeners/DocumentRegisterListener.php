<?php

namespace App\Listeners;

use App\Events\DocumentRegistered;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DocumentRegisterListener
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
     * @param  DocumentRegistered  $event
     * @return void
     */
    public function handle(DocumentRegistered  $event)
    {
        $users = User::query()->scopes('hasDocMail')->get();
        foreach ($users as $user)
            $user->sendCVEAlertNotification($event->score);
    }
}
