<?php

namespace App\Http\Controllers\WeChat\User;

use EasyWeChat\Factory;

class UserInfoController
{
    public function getUserInfo()
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));
        $user = session('wechat.oauth_user.default'); // 拿到授权用户资料
        var_dump($user);
        $userInfo = $app->user->get($user['openid']);
        dd($userInfo);
    }
}