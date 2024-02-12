<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class testStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO test_status VALUES(
            NULL,
            "Pending",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_status VALUES(
            NULL,
            "Accepted",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_status VALUES(
            NULL,
            "Declined",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_status VALUES(
            NULL,
            "Reviewing",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_status VALUES(
            NULL,
            "Processing",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_status VALUES(
            NULL,
            "Testing",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_status VALUES(
            NULL,
            "Complete",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_status VALUES(
            NULL,
            "Cancelled",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_status VALUES(
            NULL,
            "Returned",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO test_status VALUES(
            NULL,
            "Deleted",
            NOW(),
            NOW()
        );');
        
    }
}
