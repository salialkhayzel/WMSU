<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userGenders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO user_genders VALUES(
            NULL,
            "",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_genders VALUES(
            NULL,
            "Male",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_genders VALUES(
            NULL,
            "Female",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_genders VALUES(
            NULL,
            "Transgender",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_genders VALUES(
            NULL,
            "Two Spirit female",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_genders VALUES(
            NULL,
            "Two Spirit male",
            NOW(),
            NOW()
        );');
    }
}
