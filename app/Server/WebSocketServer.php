<?php

namespace App\Server;

use Swoole\WebSocket\Server;

class WebSocketServer
{

    public function run()
    {
        //创建WebSocket Server对象，监听0.0.0.0:9502端口
        $ws = new Server('0.0.0.0', 9002);

        //监听WebSocket连接打开事件
        $ws->on('Open', function ($ws, $request) {
            $ws->push($request->fd, "hello, welcome\n");
        });

        //监听WebSocket消息事件
        $ws->on('Message', function ($ws, $frame) {
            echo "Message: {$frame->data}\n";
            if ($frame->data == 1) {
                $ws->push($frame->fd, "first");
            } elseif ($frame->data == 2) {
                $ws->push($frame->fd, json_encode([
                    'a' => '123',
                    'b' => ['123', 444],
                ]));
            } else {
                $ws->push($frame->fd, "$frame->data");
            }
        });

        //监听WebSocket连接关闭事件
        $ws->on('Close', function ($ws, $fd) {
            echo "client-{$fd} is closed\n";
        });

        $ws->start();
    }
}