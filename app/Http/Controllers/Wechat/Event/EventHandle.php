<?php

namespace App\Http\Controllers\WeChat\Event;

use App\Http\Controllers\WeChat\Event\Event\RedPack;
use App\Http\Controllers\WeChat\Event\Event\ScanCodeWithPush;
use App\Http\Controllers\WeChat\Event\Event\ScanCodeWithTips;
use App\Http\Controllers\WeChat\Event\Event\Subscribe;
use App\Http\Controllers\WeChat\Event\Event\SystemPhoto;
use App\Http\Controllers\WeChat\Event\Event\SystemPhotoOrAlbum;
use App\Http\Controllers\WeChat\Event\Event\UnSubscribe;
use App\Http\Controllers\WeChat\Event\Event\Click;
use App\Http\Controllers\WeChat\Event\Event\WeChatAlbum;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;
use EasyWeChat\Kernel\Messages\Text;
use Illuminate\Support\Facades\Log;

class EventHandle implements EventHandlerInterface
{
    use Subscribe;
    use UnSubscribe;
    use RedPack;
    use Click;
    use ScanCodeWithTips;
    use ScanCodeWithPush;
    use SystemPhotoOrAlbum;
    use SystemPhoto;
    use WeChatAlbum;

    protected $payload = [];

    public function handle($payload = null)
    {
        $this->payload = $payload;
        $event = $payload['Event'];
        if (!isset($event) || !method_exists($this, $event)) {
            Log::error("wechat event is error,event is not found");
            return new Text('服务器异常');
        }
        return $this->$event();
    }
}