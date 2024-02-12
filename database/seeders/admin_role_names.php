<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class admin_role_names extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `admin_role_names` (`admin_role_name_id`, `admin_role_name_name`, `admin_role_name_details`, `date_created`, `date_updated`) VALUES
        (1, 'Administrator', 'Admin', '2023-10-31 23:14:00', '2023-10-31 23:14:00'),
        (2, 'Proctor', 'Proctor', '2023-10-31 23:14:23', '2023-10-31 23:14:23'),
        (3, 'Result Admin', 'Result Admin', '2023-10-31 23:14:37', '2023-10-31 23:14:37');");
    }
}
