<?php

namespace App\Listeners;

use App\Events\ProductOutOfStock;
use App\Notifications\ProductInventoryDepletedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendProductInventoryDepletedNotification implements ShouldQueue
{
    public function handle(ProductOutOfStock $event)
    {
        Notification::send(
            $event->product->approvedUsers,
            new ProductInventoryDepletedNotification($event->product)
        );
    }
}
