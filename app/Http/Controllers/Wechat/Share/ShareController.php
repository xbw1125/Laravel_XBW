<?php

namespace App\Http\Controllers\WeChat\Share;

use EasyWeChat\Factory;
use Illuminate\Http\Request;

class ShareController
{
    public function jsConfigInit(Request $request)
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));
        $jsApiLists = ['updateAppMessageShareData', 'updateTimelineShareData', 'getNetworkType', 'getLocation'];
        $app->jssdk->setUrl($request->get('url', 'https://xbw.loftyzone.cn/web/share'));
        return $app->jssdk->buildConfig($jsApiLists, true, false, true);
    }
}