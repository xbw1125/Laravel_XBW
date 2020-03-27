<?php

namespace App\Http\Controllers\WeChat\Event\Event;

use Illuminate\Support\Facades\Log;

trait SystemPhotoOrAlbum
{
    public function pic_photo_or_album()
    {
        $methodName = $this->payload['EventKey'];
        if (isset($methodName) && method_exists($this, $methodName)) {
            return $this->$methodName();
        }
        Log::info("NOT FOUND methodName: " . $methodName);
        return '';
    }

    public function systemPhotoOrAlbumTest()
    {
        Log::info('系统拍照或者从相册中选取照片---');
        Log::info($this->payload);
        return '';
    }
}