<?php

namespace App\Http\Controllers\WeChat\Event\Event;

use App\Http\Models\ThirdPartyUser;
use EasyWeChat\Kernel\Messages\Text;
use Illuminate\Support\Facades\Log;

trait Click
{

    public function CLICK()
    {
        $methodName = $this->payload['EventKey'];
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        }
        Log::info("NOT FOUND methodName: " . $methodName);
        return '';
    }

    public function getUserInfo()
    {
        $openid = $this->payload['FromUserName'];
        $data = ThirdPartyUser::where('platform', 'WeChat')->where('openid', $openid)->first();
        if (empty($data)) {
            return new Text('没有记录，你的openid：' . $openid);
        }
        return new Text('你的WeChat昵称：' . $data['openname']);
    }
}