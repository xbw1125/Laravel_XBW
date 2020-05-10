<?php

namespace App\Http\Controllers\Api\V1\Notification;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notification as NotificationResource;
use App\Http\Resources\NotificationList as NotificationListResource;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{

    public function sendNotification()
    {
        auth('api')->user()->notify(new SystemNotification(1));
        return $this->message('发送成功');
    }

    public function getReadNotificationLists()
    {
        $model = NotificationListResource::collection(auth('api')->user()->readNotifications()->simplePaginate(1));
        return $this->respondForPaginate($model);
    }

    public function getUnReadNotificationLists()
    {
        $model = NotificationListResource::collection(auth('api')->user()->unreadNotifications()->simplePaginate(1));
        return $this->respondForPaginate($model);
    }

    public function getUnReadNotificationCount()
    {
        return $this->success(auth('api')->user()->unreadNotifications()->count());
    }

    public function readNotification(Request $request)
    {
        $model = DatabaseNotification::find($request->input('id'));
        $model->markAsRead();
        return $this->success(new NotificationResource($model));
    }
}
