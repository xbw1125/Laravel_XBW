<?php

namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\WeChat\Event\EventHandle;
use App\Http\Controllers\Wechat\MessageHandle\ImageMessageHandler;
use App\Http\Controllers\Wechat\MessageHandle\TextMessageHandler;
use App\Http\Controllers\Wechat\MessageHandle\VoiceMessageHandler;
use EasyWeChat\Factory;
use \EasyWeChat\Kernel\Messages\Message;

class WeChatServerController
{
    public function index()
    {
        $app = Factory::officialAccount(config('wechat.official_account.default'));
        $app->server->push(TextMessageHandler::class, Message::TEXT);
        $app->server->push(ImageMessageHandler::class, Message::IMAGE);
        $app->server->push(VoiceMessageHandler::class, Message::VOICE);
        $app->server->push(EventHandle::class, Message::EVENT);
        return $app->server->serve();
    }
}