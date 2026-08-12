<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    /**
     * Update the user settings.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Debug log before update
        \Log::info('Before update - User language: ' . $user->language);
        \Log::info('Request language: ' . $request->language);

        // Update user settings
        $user->language = $request->language ?? $user->language;
        $user->email_notifications = $request->has('email_notifications') ? true : false;
        $user->sales_notifications = $request->has('sales_notifications') ? true : false;
        $user->stock_notifications = $request->has('stock_notifications') ? true : false;
        $user->save();

        // Debug log after update
        \Log::info('After update - User language: ' . $user->language);

        // Set language in session for immediate effect
        session(['locale' => $user->language]);
        app()->setLocale($user->language);

        \Log::info('Session locale set to: ' . session('locale'));
        \Log::info('App locale set to: ' . app()->getLocale());

        return redirect()->route('settings.index')->with('success', __('save_all_settings'));
    }

    /**
     * Display user notifications.
     */
    public function notifications()
    {
        $user = Auth::user();
        
        // Get all notifications for this user (including read)
        $notifications = $user->notifications()->latest()->paginate(10);
        
        // Debug info
        \Log::info('User ID: ' . $user->id);
        \Log::info('Notifications count: ' . $notifications->count());
        \Log::info('Unread count: ' . $user->unreadNotifications->count());
        
        return view('settings.notifications', compact('user', 'notifications'));
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead($notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        
        return back()->with('success', 'Notifikasi ditandai sebagai sudah dibaca.');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        
        return back()->with('success', 'Semua notifikasi ditandai sebagai sudah dibaca.');
    }

    /**
     * Get unread notification count for polling.
     */
    public function unreadCount()
    {
        $user = Auth::user();
        $count = $user->unreadNotifications->count();
        $latestNotification = $user->unreadNotifications()->latest()->first();
        
        return response()->json([
            'count' => $count,
            'notification' => $latestNotification
        ]);
    }
}
