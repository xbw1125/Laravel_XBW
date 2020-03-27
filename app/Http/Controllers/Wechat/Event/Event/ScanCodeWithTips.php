<?php

namespace App\Http\Controllers\WeChat\Event\Event;

use Illuminate\Support\Facades\Log;

trait ScanCodeWithTips
{
    public function scancode_waitmsg()
    {
        $methodName = $this->payload['EventKey'];
        if (isset($methodName) && method_exists($this, $methodName)) {
            return $this->$methodName();
        }
        Log::info("NOT FOUND methodName: " . $methodName);
        return '';
    }

    public function scanCodeWithTipsTest()
    {
        Log::info('扫码带提示---');
        Log::info($this->payload);
        return '';
    }
}