<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE departments(
            department_id INT PRIMARY KEY AUTO_INCREMENT,
            department_college_id VARCHAR(50) NOT NULL,
            department_name VARCHAR(1024) NOT NULL,
            department_details VARCHAR(1024) NOT NULL,
            department_logo VARCHAR(50),
            department_abr VARCHAR(255) ,
            department_order INT NOT NULL,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
        DB::statement('CREATE INDEX idx_department_college_id ON departments(department_college_id);');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
