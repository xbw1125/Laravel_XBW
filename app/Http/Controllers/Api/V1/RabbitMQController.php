<?php

namespace App\Http\Controllers\Api\V1;

use PhpAmqpLib\Wire\AMQPTable;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQController
{
    const ExchangeName = 'test_exchange';
    const QueueName = 'logs';

    const DeadLetterExchangeName = 'dlx_exchange';
    const DeadLetterQueueName = 'dlx_queue';
    const DeadLetterRouteKeyName = 'dlx_queue';

    public function index($msg = '没话', $route_key = '')
    {
        $connection = new AMQPStreamConnection('rabbitmq3.8', 5672, 'yunding', 'yunding123', 'yunding');
        $channel = $connection->channel();
        //申明一个交换机 并设置类型
        $channel->exchange_declare(self::ExchangeName, AMQPExchangeType::TOPIC);
        //开启发布者消息确认
        $channel->confirm_select();
        $channel->set_ack_handler(function (AMQPMessage $message) {
            echo 'ack: ' . $message->getBody() . PHP_EOL;
            Log::info('生产者接受成功消息：' . $message->getBody());
        });
        $channel->set_nack_handler(function (AMQPMessage $message) {
            echo 'nack: ' . $message->getBody() . PHP_EOL;
            Log::info('生产者接受失败消息：' . $message->getBody());
        });
        $aMQPMessage = new AMQPMessage($msg, [
            //消息持久化
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
            //死信队列 重试次数1次
            'application_headers' => new AMQPTable(["retry_nums" => 1]),
        ]);
        //消息推到交换机 根据路由key分发消息
        $channel->basic_publish($aMQPMessage, self::ExchangeName, $route_key);
        $channel->wait_for_pending_acks_returns(1);
        echo " [x] Sent " . $msg . "\n";
        Log::info('生产者发送了：' . $msg);
        $channel->close();
        $connection->close();
    }

    public function consume($route_key = '')
    {
        $num = '3';
        $route_key = $route_key ?? 'logs.error.#';
        echo '消费者启动' . $num;
        $connection = new AMQPStreamConnection('rabbitmq3.8', 5672, 'yunding', 'yunding123', 'yunding');
        $channel = $connection->channel();
        $channel->exchange_declare(self::ExchangeName, AMQPExchangeType::TOPIC);
        //死信、延时 队列
        //申明正常的普通队列 参数设置绑定延时队列信息
        $args = new AMQPTable([
            'x-dead-letter-exchange' => self::DeadLetterExchangeName, //死信交换机
            'x-message-ttl' => 10000, //消息存活时间毫秒（超过设置的时间就自动转发到设置的死信队列中）
            'x-dead-letter-routing-key' => self::DeadLetterRouteKeyName // 死信路由key
        ]);
        $channel->queue_declare(self::QueueName, false, true, false, false, false, $args);
        $channel->queue_bind(self::QueueName, self::ExchangeName, $route_key);
        //申明绑定死信queue
        $channel->exchange_declare(self::DeadLetterExchangeName, AMQPExchangeType::TOPIC, false, true, false);
        $channel->queue_declare(self::DeadLetterQueueName, false, true, false, false);
        $channel->queue_bind(self::DeadLetterQueueName, self::DeadLetterExchangeName, self::DeadLetterRouteKeyName, false);

        $callback = function (AMQPMessage $msg) use ($num) {
            echo '第' . $num . '个消费者接收了：' . $msg->body . PHP_EOL;
            Log::info('第' . $num . '个消费者接收了：' . $msg->body);
            $msg->ack();
        };
        $channel->basic_qos(null, 1, null);
        $channel->basic_consume(self::QueueName, '', false, false, false, false, $callback);
        while ($channel->is_consuming()) {
            Log::info($num . '等待消费中');
            $channel->wait();
        }
        $channel->close();
        $connection->close();
    }
}