<?php

namespace App\Http\Controllers\Wechat\MessageHandle;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class TextMessageHandler implements EventHandlerInterface
{
    public function handle($payload = null)
    {
        return $payload['Content'];
    }
}