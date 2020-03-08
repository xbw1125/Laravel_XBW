<?php

namespace App\Http\Controllers\WeChat\Event\Payment;

use EasyWeChat\Factory;

class Payment
{
    protected $payment;

    public function __construct()
    {
        $this->payment = Factory::payment(config('wechat.payment.default'));
    }
}
