<?php

namespace App\Listeners;

use App\Events\UserSubscribed;
use App\Jobs\CustomerJob;
use App\Mail\UserSubscribedMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailOwnerAboutSubscription
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
     * listeners會接到一個event類別的值
     */
    public function handle(UserSubscribed $event): void
    {
        //使用job來將郵件存入queue 
        //dispatch(new CustomerJob($event->email));
        Mail::to($event->email)->send(new UserSubscribedMessage());
    }
}
