<?php

namespace App\Http\Controllers\WeChat\MessageHandle;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;
use EasyWeChat\Kernel\Messages\Text;
use Illuminate\Support\Facades\Log;

class LocationMessageHandler implements EventHandlerInterface
{
    public function handle($payload = null)
    {
        Log::info('地理位置信息-----------' . $payload);
        return new Text($payload['Location_X'] . '--' . $payload['Location_Y'] . '--' . $payload['Label']);
    }
}