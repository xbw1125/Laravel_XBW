<?php

namespace App\Http\Controllers\WeChat\Event\Event;

use Illuminate\Support\Facades\Log;

trait UnSubscribe
{

    public function unsubscribe()
    {
        Log::info('该用户取消关注啦---' . $this->payload['FromUserName']);
        return '';
    }
}
