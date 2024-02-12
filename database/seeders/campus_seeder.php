<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class campus_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO campuses VALUES(
            NULL,
            "MAIN CAMPUS",
            "",
            "",
            1,
            NOW(),
            NOW()
        );');
    }
}
