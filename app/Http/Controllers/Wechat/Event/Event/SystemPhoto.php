<?php

namespace App\Http\Controllers\WeChat\Event\Event;

use Illuminate\Support\Facades\Log;

trait SystemPhoto
{
    public function pic_sysphoto()
    {
        $methodName = $this->payload['EventKey'];
        if (isset($methodName) && method_exists($this, $methodName)) {
            return $this->$methodName();
        }
        Log::info("NOT FOUND methodName: " . $methodName);
        return '';
    }

    public function systemPhotoTest()
    {
        Log::info('系统拍照---');
        Log::info($this->payload);
        return '';
    }
}