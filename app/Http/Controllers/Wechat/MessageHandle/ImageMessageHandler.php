<?php

namespace App\Http\Controllers\WeChat\MessageHandle;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class ImageMessageHandler implements EventHandlerInterface
{
    public function handle($payload = null)
    {
        return $payload['PicUrl'];
    }
}