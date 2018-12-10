<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abcs')->delete();

        for ($i=0; $i < 5; $i++) {
            \App\Abc::create([
                'title'   => 'Title '.$i,
                'body'    => 'Body '.$i,
                'user_id' => 1,
            ]);
        }
    }
}
