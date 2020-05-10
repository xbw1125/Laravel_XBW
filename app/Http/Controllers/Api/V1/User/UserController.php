<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\ThirdPartyUser;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use App\Http\Resources\NotificationList as NotificationListResource;
use App\Http\Resources\Notification as NotificationResource;
use Illuminate\Notifications\DatabaseNotification;

class UserController extends Controller
{

    public function getUserInfo(Request $request)
    {
        $result = ThirdPartyUser::where('uid', $request->get('uid'))
            ->where('platform', $request->get('platform'))
            ->first();

        if ($result->openid == $request->get('openid')) {
            $user = User::findOrFail($request->get('uid'))->toArray();
            return $this->success($user);
        }
        return $this->failed('查询失败', 403);
    }
}