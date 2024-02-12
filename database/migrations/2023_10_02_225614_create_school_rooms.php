<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE school_rooms(
            school_room_id INT PRIMARY KEY AUTO_INCREMENT,
            school_room_isactive BOOL DEFAULT 1,
            school_room_bldg_name VARCHAR(100) ,
            school_room_bldg_abr VARCHAR(100) ,
            school_room_name VARCHAR(100) ,
            school_room_number VARCHAR(100) ,

            school_room_max_capacity INT NOT NULL,

            school_room_proctor_user_id INT DEFAULT NULL,

            school_room_test_center_id INT DEFAULT 29,

            school_room_description VARCHAR(255),
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
        DB::statement('CREATE INDEX idx_school_room_proctor_user_id ON school_rooms(school_room_proctor_user_id);');
        DB::statement('CREATE INDEX idx_school_room_test_center_id ON school_rooms(school_room_test_center_id);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_rooms');
    }
}
