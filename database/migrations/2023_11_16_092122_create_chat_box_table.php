<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatBoxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE chat_box(
            chat_box_id INT PRIMARY KEY AUTO_INCREMENT,
            chat_box_admin BOOL DEFAULT 1,
            chat_box_status_id INT NOT NULL,
            chat_box_user_sender INT NOT NULL,
            chat_box_user_receiver INT NOT NULL,
            chat_box_sender_isread BOOL DEFAULT 0,
            chat_box_receiver_isread BOOL DEFAULT 0,
            chat_box_cbc_id INT NOT NULL,
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
        Schema::dropIfExists('chat_box');
    }
}
