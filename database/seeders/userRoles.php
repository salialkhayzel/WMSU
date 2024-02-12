<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO user_roles VALUES(
            NULL,
            "student",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_roles VALUES(
            NULL,
            "admin",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_roles VALUES(
            NULL,
            "superadmin",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO user_roles VALUES(
            NULL,
            "",
            NOW(),
            NOW()
        );');
        
        
        
        
    }
}
