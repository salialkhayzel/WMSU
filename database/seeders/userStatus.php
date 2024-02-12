<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO user_status VALUES(
            NULL,
            "active",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_status VALUES(
            NULL,
            "inactive",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_status VALUES(
            NULL,
            "deleted",
            NOW(),
            NOW()
        );');
        
    }
}
