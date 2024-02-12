<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE features(
            feature_id INT PRIMARY KEY AUTO_INCREMENT,
            feature_header VARCHAR(1024) NOT NULL,
            feature_content VARCHAR(1024) NOT NULL,
            feature_button_name VARCHAR(100) NOT NULL,
            feature_link VARCHAR(1024) NOT NULL,
            feature_order INT NOT NULL,
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
        Schema::dropIfExists('features');
    }
}
