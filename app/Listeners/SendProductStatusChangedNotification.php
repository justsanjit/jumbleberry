<?php

namespace App\Listeners;

use App\Events\ProductStatusChanged;
use App\Notifications\ProductStatusChangedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendProductStatusChangedNotification implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProductStatusChanged $event)
    {
        Notification::send(
            $event->product->approvedUsers,
            new ProductStatusChangedNotification($event->product)
        );
    }
}
