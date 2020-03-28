<?php

namespace App\Http\Controllers\WeChat\Share;

use EasyWeChat\Factory;

class ShareController
{
    public function jsConfigInit()
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));
        $jsApiLists = ['updateAppMessageShareData', 'updateTimelineShareData', 'getNetworkType', 'getLocation'];
        return $app->jssdk->buildConfig($jsApiLists, true, false, true);
    }
}