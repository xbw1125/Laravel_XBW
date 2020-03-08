<?php

namespace App\Http\Controllers\WeChat\Event\Payment;

use EasyWeChat\Factory;
use Illuminate\Support\Facades\Log;

class RedPack extends Payment
{
    private $redPack;
    private $redPackData;
    private $result;
    public function __construct()
    {
        $this->redPack = $this->payment->redpack;
    }

    public function setRedPackData($redPackData)
    {
        $this->redPackData = $redPackData;
    }

    public function getRedPackData()
    { }


    public function sendNormal()
    {
        $this->result = $this->redPack->sendNormal($this->redPackData);
    }

    public function sendGroup()
    {
        $redPackData = [
            'mch_billno'   => 'xy123456',
            'send_name'    => '测试红包',
            're_openid'    => 'oxTWIuGaIt6gTKsQRLau2M0yL16E',
            'total_num'    => 3,  //不小于3
            'total_amount' => 300,  //单位为分，不小于300
            'wishing'      => '祝福语',
            'act_name'     => '测试活动',
            'remark'       => '测试备注',
            'amt_type'     => 'ALL_RAND',  //可不传
            // ...
        ];
        $this->result = $this->redPack->sendGroup($this->redPackData);
    }

    public function prepare()
    {
        $redPackData = [
            'hb_type'      => 'NORMAL',  //NORMAL 或 GROUP
            'mch_billno'   => 'xy123456',
            'send_name'    => '测试红包',
            're_openid'    => 'oxTWIuGaIt6gTKsQRLau2M0yL16E',
            'total_num'    => 1,  //普通红包固定为1，裂变红包不小于3
            'total_amount' => 100,  //单位为分，普通红包不小于100，裂变红包不小于300
            'wishing'      => '祝福语',
            'client_ip'    => '192.168.0.1',  //可不传，不传则由 SDK 取当前客户端 IP
            'act_name'     => '测试活动',
            'remark'       => '测试备注',
            'amt_type'     => 'ALL_RAND',
            // ...
        ];
        $this->result = $this->redPack->prepare($this->redPackData);
    }

    public function info()
    {
        $mchBillNo = "商户系统内部的订单号（mch_billno）";
        $this->result = $this->redPack->info($mchBillNo);
    }

    public function __destruct()
    {
        Log::info('====================END====================');
    }
}
