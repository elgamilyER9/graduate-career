<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all notifications for user
     */
    public function index()
    {
        $user = auth()->user();
        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->paginate(15);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get unread count
     */
    public function unreadCount()
    {
        $user = auth()->user();
        $count = Notification::where('user_id', $user->id)
            ->where('read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Get recent notifications (AJAX)
     */
    public function recent()
    {
        $user = auth()->user();
        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        return response()->json($notifications);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Notification $notification)
    {
        $this->authorize('view', $notification);
        $notification->markAsRead();

        return back()->with('success', __('Notification marked as read.'));
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        $user = auth()->user();
        Notification::where('user_id', $user->id)
            ->where('read', false)
            ->update(['read' => true]);

        return back()->with('success', __('All notifications marked as read.'));
    }

    /**
     * Delete notification
     */
    public function destroy(Notification $notification)
    {
        $this->authorize('delete', $notification);
        $notification->delete();

        return back()->with('success', __('Notification deleted.'));
    }

    /**
     * Clear all notifications
     */
    public function clear()
    {
        $user = auth()->user();
        Notification::where('user_id', $user->id)->delete();

        return back()->with('success', __('All notifications cleared.'));
    }
}
