<?php

namespace App\Http\Controllers\WeChat\Event\Event;

use Illuminate\Support\Facades\Log;

trait WeChatAlbum
{
    public function pic_weixin()
    {
        $methodName = $this->payload['EventKey'];
        if (isset($methodName) && method_exists($this, $methodName)) {
            return $this->$methodName();
        }
        Log::info("NOT FOUND methodName: " . $methodName);
        return '';
    }

    public function weChatAlbumTest()
    {
        Log::info('微信相册发图---' . $this->payload);
        return '';
    }
}