<?php

namespace App\Console\Commands\RabbitMQ;

use App\Http\Controllers\Api\V1\RabbitMQController;
use Illuminate\Console\Command;

set_time_limit(0); //解除PHP脚本时间30s限制
ini_set('memory_limit', '128M');//修改内存值
class Consumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:consumer {route_key?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 执行控制台命令。
     */
    public function handle()
    {
        (new RabbitMQController())->consume($this->argument('route_key'));
    }
}