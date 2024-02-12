<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE appointments(
            appointment_id INT PRIMARY KEY AUTO_INCREMENT,
            appointment_user_id INT NOT NULL,
            appointment_status_id INT NOT NULL,
            appointment_preferred_date DATE,
            appointment_preferred_time TIME,
            appointment_purpose VARCHAR(1024),
            appointment_message VARCHAR(1024),
            appointment_datetime DATETIME DEFAULT NULL,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (appointment_user_id) REFERENCES users(user_id)
        );');

        DB::statement('CREATE INDEX idx_appointment_status_id ON appointments(appointment_status_id);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
