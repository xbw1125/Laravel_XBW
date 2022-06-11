<?php

namespace App\Console\Commands\Canal;

use Illuminate\Console\Command;
use App\Http\Controllers\Api\V1\Canal\CanalController;

class CanalServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'canal-test';

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
        (new CanalController())->index();
    }

}