<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyBackground extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE user_family_background(
            family_background_id INT PRIMARY KEY AUTO_INCREMENT,
            family_background_user_id INT NOT NULL UNIQUE, 
            family_background_m_firstname VARCHAR(100) DEFAULT NULL,
            family_background_m_middlename VARCHAR(100) DEFAULT NULL,
            family_background_m_lastname VARCHAR(100) DEFAULT NULL,
            family_background_m_suffix VARCHAR(100) DEFAULT NULL,
            family_background_f_firstname VARCHAR(100) DEFAULT NULL,
            family_background_f_middlename VARCHAR(100) DEFAULT NULL,
            family_background_f_lastname VARCHAR(100) DEFAULT NULL,
            family_background_f_suffix VARCHAR(100) DEFAULT NULL,
            family_background_g_firstname VARCHAR(100) DEFAULT NULL,
            family_background_g_middlename VARCHAR(100) DEFAULT NULL,
            family_background_g_lastname VARCHAR(100) DEFAULT NULL,
            family_background_g_suffix VARCHAR(100) DEFAULT NULL,
            family_background_g_relationship VARCHAR(100) DEFAULT NULL,
            family_background_number_of_siblings INT DEFAULT NULL,
            family_background_address VARCHAR(255) DEFAULT NULL,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
        DB::statement('CREATE INDEX idx_m_full_name ON user_family_background(family_background_m_firstname(10),family_background_m_lastname(10),family_background_m_middlename(10));');
        DB::statement('CREATE INDEX idx_f_full_name ON user_family_background(family_background_f_firstname(10),family_background_f_lastname(10),family_background_f_middlename(10));');
        DB::statement('CREATE INDEX idx_g_full_name ON user_family_background(family_background_g_firstname(10),family_background_g_lastname(10),family_background_g_middlename(10));');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_family_background');
    }
}
