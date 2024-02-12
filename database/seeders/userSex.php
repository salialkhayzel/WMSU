<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSex extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO user_sex VALUES(
            NULL,
            "",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_sex VALUES(
            NULL,
            "Male",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_sex VALUES(
            NULL,
            "Female",
            NOW(),
            NOW()
        );');
    }
}
