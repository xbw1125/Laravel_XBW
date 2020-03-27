<?php

namespace App\Http\Controllers\WeChat\MessageHandle;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;
use Illuminate\Support\Facades\Log;

class VoiceMessageHandler implements EventHandlerInterface
{
    public function handle($payload = null)
    {
        Log::info($payload);
        return $payload['Recognition'];
    }
}