<?php

namespace App\Http\Controllers\WeChat;

use EasyWeChat\Factory;

class ServerVerifyController
{
    public function index()
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));
        return $app->server->serve();
    }
}