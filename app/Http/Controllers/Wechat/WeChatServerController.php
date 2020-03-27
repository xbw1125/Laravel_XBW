<?php

namespace App\Http\Controllers\WeChat;

use EasyWeChat\Factory;
use \EasyWeChat\Kernel\Messages\Message;
use App\Http\Controllers\WeChat\Event\EventHandle;
use App\Http\Controllers\WeChat\MessageHandle\ImageMessageHandler;
use App\Http\Controllers\WeChat\MessageHandle\TextMessageHandler;
use App\Http\Controllers\WeChat\MessageHandle\VoiceMessageHandler;

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