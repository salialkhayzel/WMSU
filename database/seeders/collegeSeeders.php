<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class collegeSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO colleges VALUES(
            NULL,
            "agri.png",
            "College Of Agriculture",
            "teaches modern farming, crop cultivation, animal husbandry, and sustainable practices. Students gain agribusiness skills for diverse careers in agriculture, emphasizing innovation and sustainability...",
            1,
            1,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO colleges VALUES(
            NULL,
            "arch.png",
            "College Of Architecture",
            "Imparts design, construction, and urban planning education. Students learn architectural theory, building technology, and sustainability, honing skills in functional space creation...",
            1,
            2,
            1,
            NOW(),
            NOW()
        );');
    }
}
