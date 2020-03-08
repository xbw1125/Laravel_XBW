<?php

namespace App\Http\Controllers\WeChat\Event\Event;

use App\Http\Controllers\WeChat\Event\Payment\RedPack as PaymentRedPack;

trait RedPack
{

    public function sendRedPack()
    {
        $paymentRedPack = new PaymentRedPack();
        $paymentRedPack->setRedPackData([
            'mch_billno' => 'xy123456',
            'send_name' => '测试红包',
            're_openid' => 'oxTWIuGaIt6gTKsQRLau2M0yL16E',
            'total_num' => 1,  //固定为1，可不传
            'total_amount' => 100,  //单位为分，不小于100
            'wishing' => '祝福语',
            'client_ip' => '192.168.0.1',  //可不传，不传则由 SDK 取当前客户端 IP
            'act_name' => '测试活动',
            'remark' => '测试备注',
            // ...
        ]);
        $paymentRedPack->sendNormal();
        return 'thank you';
    }
}
