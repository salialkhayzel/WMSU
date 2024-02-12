<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class cet_type_lists extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO cet_types VALUES(
            NULL,
            "shs_under_grad",
            "SENIOR HIGH SCHOOL GRADUATING STUDENT",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO cet_types VALUES(
            NULL,
            "shs_grad",
            "SENIOR HIGH SCHOOL GRADUATE",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO cet_types VALUES(
            NULL,
            "shiftee/tranferee",
            "SHIFTEE / TRANSFEREE STUDENT",
            NOW(),
            NOW()
        );');
    }
}
