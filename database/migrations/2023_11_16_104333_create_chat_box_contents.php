<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatBoxContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::statement('CREATE TABLE chat_box_contents(
            cbc_id INT PRIMARY KEY AUTO_INCREMENT,
            cbc_chat_box_id INT NOT NULL,
            cbc_user_id INT NOT NULL,
            cbc_chat_content_type_id INT NOT NULL DEFAULT 1,
            cbc_chat_content VARCHAR(1024),
            chat_box_sender_isread BOOL DEFAULT 0,
            chat_box_receiver_isread BOOL DEFAULT 0,
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
        Schema::dropIfExists('chat_box_contents');
    }
}
