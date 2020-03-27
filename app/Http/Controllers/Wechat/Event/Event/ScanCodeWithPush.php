<?php

namespace App\Http\Controllers\WeChat\Event\Event;

use Illuminate\Support\Facades\Log;

trait ScanCodeWithPush
{
    public function scancode_push()
    {
        $methodName = $this->payload['EventKey'];
        if (isset($methodName) && method_exists($this, $methodName)) {
            return $this->$methodName();
        }
        Log::info("NOT FOUND methodName: " . $methodName);
        return '';
    }

    public function scanCodeWithPushTest()
    {
        Log::info('扫码推送事件---');
        Log::info($this->payload);
        return '';
    }
}