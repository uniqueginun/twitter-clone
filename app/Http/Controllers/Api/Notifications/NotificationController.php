<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\NotificationCollection;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request)
    {
        $notifications = $request->user()
                             ->notifications()
                             ->paginate(1);

        return new NotificationCollection($notifications);
    }
}
