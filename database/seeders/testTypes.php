<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class testTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO test_types VALUES(
            NULL,
            "CET",
            "College Entrance Test",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_types VALUES(
            NULL,
            "NAT",
            "Nursing Aptitude Test",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_types VALUES(
            NULL,
            "EAT",
            "Engineering Aptitude Test",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_types VALUES(
            NULL,
            "GSAT",
            "GSAT",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_types VALUES(
            NULL,
            "LSAT",
            "LSAT",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_types VALUES(
            NULL,
            "HRMAT",
            "HRMAT",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_types VALUES(
            NULL,
            "JRAT",
            "JRAT",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_types VALUES(
            NULL,
            "KSAT",
            "KSAT",
            NOW(),
            NOW()
        );');
        
    }
}
