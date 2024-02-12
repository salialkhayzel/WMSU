<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserForgotPassword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE user_forgot_passwords(
            user_forgot_password_id INT PRIMARY KEY AUTO_INCREMENT,
            user_forgot_password_email VARCHAR(100) NOT NULL,
            user_forgot_password_hash VARCHAR(100) NOT NULL,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');

        DB::statement('CREATE INDEX idx_user_forgot_password_email ON user_forgot_passwords(user_forgot_password_email(10));');
        DB::statement('CREATE INDEX idx_user_forgot_password_hash ON user_forgot_passwords(user_forgot_password_hash(10));');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_forgot_password');
    }
}
