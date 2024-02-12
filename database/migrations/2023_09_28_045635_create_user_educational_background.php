<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEducationalBackground extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE user_educational_background(
            ueb_id INT PRIMARY KEY AUTO_INCREMENT,
            ueb_user_id INT NOT NULL UNIQUE,
            ueb_shs_school_name VARCHAR(100) ,
            ueb_shs_address VARCHAR(100) ,

            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (ueb_user_id) REFERENCES users(user_id)
        );');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_educational_background');
    }
}
