<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('pre_tracker_android_times_2020')->delete();

        for ($i = 0; $i < 10000; $i++) {
            DB::table('pre_tracker_android_times_2020')->insert([
                'uid' => rand(1, 4252246),
                'uuid' => md5(uniqid(microtime(true), true)),
                'getXGToken' => md5('123456' . rand(1, 4252246)),
                'getMid' => md5('1234569823' . rand(1, 4252246)),
                'getImei' => md5('asdff' . rand(1, 4252246)),
                'isUsageAccessEnable' => 'true',
                'created_at' => '2020-' . rand(1, 12) . '-' . rand(1, 28) . '-' . rand(1, 12) . '-' . rand(1, 59) . '-' . rand(1, 59),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);
        }
    }
}
