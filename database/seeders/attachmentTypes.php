<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class attachmentTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO attachment_types VALUES(
            NULL,
            "",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO attachment_types VALUES(
            NULL,
            "hs_attachment",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO attachment_types VALUES(
            NULL,
            "shs_attachment",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO attachment_types VALUES(
            NULL,
            "shs_transcript_of_record",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO attachment_types VALUES(
            NULL,
            "hs_transcript_of_record",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO attachment_types VALUES(
            NULL,
            "valid_id",
            NOW(),
            NOW()
        );');
    }
}
