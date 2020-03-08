<?php

namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\WeChat\Event\EventHandle;
use App\Http\Controllers\Wechat\MessageHandle\ImageMessageHandler;
use App\Http\Controllers\Wechat\MessageHandle\TextMessageHandler;
use EasyWeChat\Factory;
use \EasyWeChat\Kernel\Messages\Message;
use Illuminate\Support\Facades\Log;

class WeChatServerController
{
    public function index()
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));
        Log::info($app->server->getMessage() . PHP_EOL); //记录微信推过来的参数
        $app->server->push(TextMessageHandler::class, Message::TEXT);
        $app->server->push(ImageMessageHandler::class, Message::IMAGE);
        $app->server->push(ImageMessageHandler::class, Message::VOICE);
        $app->server->push(EventHandle::class, Message::EVENT);
        return $app->server->serve();
    }
}