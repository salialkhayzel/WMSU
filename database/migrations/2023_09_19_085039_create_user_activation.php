<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE user_activations(
            user_activation_id INT PRIMARY KEY AUTO_INCREMENT,
            user_activation_email VARCHAR(100) NOT NULL,
            user_activation_code INT NOT NULL,
            user_activation_count INT DEFAULT 0,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');

        DB::statement('CREATE INDEX idx_user_activation_code ON user_activations(user_activation_code);');
        DB::statement('CREATE INDEX idx_user_activation_email ON user_activations(user_activation_email(10));');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activation');
    }
}
