<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Notifications\NewBookingNotification;

final class SendNewBookingListener
{
    public function handle(BookingCreated $event): void
    {
        $event->booking->mentor->user->notify(new NewBookingNotification($event->booking));
        $event->booking->mentee->notify(new NewBookingNotification($event->booking));
    }
}
