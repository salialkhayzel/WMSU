<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class schoolTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO school_types VALUES(
            NULL,
            "Pilar College ,Inc",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO school_types VALUES(
            NULL,
            "Western Mindanao State University",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO school_types VALUES(
            NULL,
            "Southern City College",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO school_types VALUES(
            NULL,
            "Polytechnic University of the Philippines",
            NOW(),
            NOW()
        );');
    }
}
