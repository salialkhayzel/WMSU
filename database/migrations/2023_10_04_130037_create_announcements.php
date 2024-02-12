<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE announcements(
            announcement_id INT PRIMARY KEY AUTO_INCREMENT,
            announcement_type BOOL DEFAULT 1,
            announcement_title VARCHAR(255),
            announcement_content VARCHAR(1024),
            announcement_content_image VARCHAR(50),
            announcement_start_date DATE ,
            announcement_end_date DATE  ,
            announcement_isactive BOOL DEFAULT 1,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
