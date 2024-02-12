<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class statusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO statuses VALUES(
            NULL,
            "active",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO statuses VALUES(
            NULL,
            "inactive",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO statuses VALUES(
            NULL,
            "deleted",
            NOW(),
            NOW()
        );');
    }
}
