<?php

namespace App\Console\Commands\Server;

use App\Server\WebSocketServer;
use Illuminate\Console\Command;

class WebSocket extends Command
{
    protected $signature = 'server:websocket';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        (new WebSocketServer())->run();
    }
}