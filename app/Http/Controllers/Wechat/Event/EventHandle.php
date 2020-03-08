<?php

namespace App\Http\Controllers\WeChat\Event;

use App\Http\Controllers\WeChat\Event\Event\RedPack;
use App\Http\Controllers\WeChat\Event\Event\Subscribe;
use App\Http\Controllers\WeChat\Event\Event\UnSubscribe;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;
use EasyWeChat\Kernel\Messages\Text;
use Illuminate\Support\Facades\Log;

class EventHandle implements EventHandlerInterface
{
    use Subscribe;
    use UnSubscribe;
    use RedPack;

    public function handle($payload = null)
    {
        $event = $payload['Event'];
        if (!$event || !method_exists($this, $event)) {
            Log::error("wechat event is error,event is not found");
            return new Text('服务器异常');
        }
        return new Text($this->$event());
    }
}