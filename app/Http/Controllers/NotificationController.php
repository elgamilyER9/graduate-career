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

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => __('Notification marked as read.')
            ]);
        }

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

    /**
     * Admin: Get all notifications from all users (latest)
     */
    public function adminIndex(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, __('Unauthorized'));
        }

        $query = Notification::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('read')) {
            $query->where('read', $request->input('read') === '1');
        }

        $notifications = $query->paginate(20);
        $totalCount = Notification::count();
        $unreadCount = Notification::where('read', false)->count();

        return view('notifications.admin_index', compact('notifications', 'totalCount', 'unreadCount'));
    }
}
