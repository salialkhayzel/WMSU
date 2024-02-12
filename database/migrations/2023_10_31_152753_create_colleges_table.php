<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE colleges(
            college_id INT PRIMARY KEY AUTO_INCREMENT,
            college_logo VARCHAR(50) NOT NULL,
            college_header VARCHAR(1024) NOT NULL,
            college_content VARCHAR(1024) NOT NULL,
            college_campus_id INT NOT NULL,
            college_order INT NOT NULL,
            college_isactive BOOL NOT NULL DEFAULT 1,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
        
        DB::statement('CREATE INDEX idx_college_campus_id ON colleges(college_campus_id);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colleges');
    }
}
