<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE access_roles(
            access_role_id INT PRIMARY KEY AUTO_INCREMENT,
            access_role_user_id INT NOT NULL,
            access_role_module_id INT NOT NULL,
            access_role_create BOOL DEFAULT 0,
            access_role_read BOOL DEFAULT 0,
            access_role_update BOOL DEFAULT 0,
            access_role_delete BOOL DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (access_role_module_id) REFERENCES modules(module_id),
            FOREIGN KEY (access_role_user_id) REFERENCES users(user_id)
        );');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_roles');
    }
}
