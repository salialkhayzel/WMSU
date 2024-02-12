<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class schoolYears extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO school_years VALUES(
            NULL,
            CONCAT(YEAR(NOW()),"-",YEAR(NOW())+1),
            NOW(),
            NOW()
        );');
    }
}
