<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = AppNotification::latest()->paginate(25);

        return view('notifications.index', compact('notifications'));
    }

    public function markRead(AppNotification $notification)
    {
        $notification->update(['read_at' => now()]);

        return back();
    }

    public function markAllRead()
    {
        AppNotification::whereNull('read_at')->update(['read_at' => now()]);

        return back()->with('success', 'All notifications marked as read.');
    }
}
