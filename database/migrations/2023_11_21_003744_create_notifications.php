<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE notifications(
            notification_id INT PRIMARY KEY AUTO_INCREMENT,
            notification_user_target INT NOT NULL ,
            notification_user_creator INT NOT NULL ,
            notification_icon_id INT NOT NULL ,
            notification_title VARCHAR(1024) NOT NULL ,
            notification_content VARCHAR(1024) NOT NULL ,
            notiication_isread BOOL DEFAULT 1,
            notification_link VARCHAR(1024) DEFAULT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');

        DB::statement('CREATE INDEX idx_notification_user_target ON notifications(notification_user_target);');
        DB::statement('CREATE INDEX idx_notification_user_creator ON notifications(notification_user_creator);');
        DB::statement('CREATE INDEX idx_notification_icon_id ON notifications(notification_icon_id);');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
