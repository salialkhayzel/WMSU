<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE admin_roles(
            access_role_id INT PRIMARY KEY AUTO_INCREMENT,
            access_role_name_id INT NOT NULL,
            access_role_module_id INT NOT NULL,
            access_role_create BOOL DEFAULT 0,
            access_role_read BOOL DEFAULT 0,
            access_role_update BOOL DEFAULT 0,
            access_role_delete BOOL DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
        DB::statement('CREATE INDEX idx_access_role_module_id ON admin_roles(access_role_module_id);');
        DB::statement('CREATE INDEX idx_access_role_name_id ON admin_roles(access_role_name_id);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_roles');
    }
}
