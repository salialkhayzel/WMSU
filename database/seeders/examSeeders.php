<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class examSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO exam_schedules VALUES(
            NULL,
            "College Entrance Test",
            "CET",
            DATE(NOW()),
            DATE_ADD(DATE(NOW()),INTERVAL 90 DAY),
            1,
             NOW(),
            NOW());');

        DB::statement('INSERT INTO exam_schedules VALUES(
            NULL,
            "Nursing Aptitude Test",
            "NAT",
            DATE(NOW()),
            DATE_ADD(DATE(NOW()),INTERVAL 90 DAY),
            1,
            NOW(),
            NOW());');

        DB::statement('INSERT INTO exam_schedules VALUES(
            NULL,
            "Engineering Aptitude Test",
            "EAT",
            DATE(NOW()),
            DATE_ADD(DATE(NOW()),INTERVAL 90 DAY),
            1,
            NOW(),
            NOW());');
        DB::statement('INSERT INTO exam_schedules VALUES(
            NULL,
            "Law School Admission Test",
            "LSAT",
            DATE(NOW()),
            DATE_ADD(DATE(NOW()),INTERVAL 90 DAY),
            1,
            NOW(),
            NOW());');
        DB::statement('INSERT INTO exam_schedules VALUES(
            NULL,
            "Graduate Sschool admission Test",
            "GSAT",
            DATE(NOW()),
            DATE_ADD(DATE(NOW()),INTERVAL 90 DAY),
            1,
            NOW(),
            NOW());');
    }
}
