<?php

namespace App\Http\Controllers\WeChat\MessageHandle;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class TextMessageHandler implements EventHandlerInterface
{
    public function handle($payload = null)
    {
        return $payload['Content'];
    }
}