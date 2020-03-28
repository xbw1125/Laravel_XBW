<?php

namespace App\Http\Controllers\WeChat\Share;

use EasyWeChat\Factory;

class ShareController
{
    public function jsConfigInit()
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));
        $jsApiLists = ['updateAppMessageShareData', 'updateTimelineShareData', 'getNetworkType', 'getLocation'];
        $app->jssdk->setUrl(env('APP_URL', 'https://xbw.loftyzone.cn'));
        return $app->jssdk->buildConfig($jsApiLists, true, false, true);
    }
}