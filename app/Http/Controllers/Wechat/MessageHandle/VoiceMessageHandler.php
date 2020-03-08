<?php

namespace App\Http\Controllers\Wechat\MessageHandle;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class VoiceMessageHandler implements EventHandlerInterface
{
    public function handle($payload = null)
    {
        return $payload['Recognition'];
    }
}