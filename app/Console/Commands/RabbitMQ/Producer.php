<?php

namespace App\Console\Commands\RabbitMQ;

use App\Http\Controllers\Api\V1\RabbitMQController;
use Illuminate\Console\Command;

class Producer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:producer {msg} {route_key?}';

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
        (new RabbitMQController())->index($this->argument('msg'), $this->argument('route_key'));
    }
}