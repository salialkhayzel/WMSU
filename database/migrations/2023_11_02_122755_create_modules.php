<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE modules(
            module_id INT PRIMARY KEY AUTO_INCREMENT,
            module_name VARCHAR(100) UNIQUE,
            module_nav_name VARCHAR(100) NOT NULL,
            module_nav_route VARCHAR(100) NOT NULL,
            module_nav_icon VARCHAR(100) NOT NULL,
            module_number INT NOT NULL,
            module_isactive BOOL DEFAULT 1,
            moudule_group_id INT DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
        DB::statement('CREATE INDEX idx_module_number ON modules(module_number);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
