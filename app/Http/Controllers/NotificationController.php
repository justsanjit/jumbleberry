<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return view('notifications', [
            'notifications' => $request->user()->unreadNotifications()->get()
        ]);
    }

    public function read($notification, Request $request)
    {
        /** @var DatabaseNotification */
       $notification = $request->user()
            ->unreadNotifications()
            ->where('id', $notification)
            ->firstOrFail();

        $notification->markAsRead();

        return back();
    }
}
