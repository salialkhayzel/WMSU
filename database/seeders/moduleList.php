<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class moduleList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "dashboard",
            "Dashboard",
            "admin-dashboard",
            "bi bi-bar-chart-line-fill",
            1,
            1,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "appointment",
            "Appointment Management",
            "appointment-management",
            "bi bi-calendar-event",
            2,
            1,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "applicant",
            "Applicant Management",
            "application-management",
            "bi bi-briefcase",
            3,
            1,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "room",
            "Room Management",
            "room-management",
            "bi bi-door-open-fill",
            4,
            1,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "exam-m",
            "Exam Management",
            "exam-management",
            "bi bi-file-earmark-text",
            5,
            0,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "exam-a",
            "Exam Administrator",
            "exam-administrator",
            "bi bi-file-text",
            6,
            1,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "result",
            "Result Management",
            "result-management",
            "bi bi-person",
            7,
            1,
            1,
            NOW(),
            NOW()
        );');
        
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "schedule",
            "Registration Management",
            "schedule-management",
            "bi bi-calendar",
            8,
            1,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "announcement",
            "Announcement Management",
            "announcement-management",
            "bi bi-megaphone",
            9,
            1,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "admin",
            "Admin Management",
            "admin-management",
            "bi bi-person",
            10,
            1,
            1,
            NOW(),
            NOW()
        );');
       
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "program",
            "Program Management",
            "program-management",
            "bi bi-building",
            11,
            1,
            1,
            NOW(),
            NOW()
        );');
         DB::statement('INSERT INTO modules VALUES(
            NULL,
            "chat",
            "Chat Support",
            "chatsupport",
            "bi bi-chat-dots",
            12,
            1,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO modules VALUES(
            NULL,
            "settings",
            "Settings",
            "setting",
            "bi bi-gear",
            13,
            1,
            1,
            NOW(),
            NOW()
        );');
        
       
    }
}
