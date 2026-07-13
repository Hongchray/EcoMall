<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\NotificationCollection;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(20);
        return new NotificationCollection($notifications);
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->firstOrFail();
        $notification->markAsRead();

        return response()->json([
            'result' => true,
            'message' => translate('Notification marked as read')
        ]);
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json([
            'result' => true,
            'message' => translate('All notifications marked as read')
        ]);
    }
}
