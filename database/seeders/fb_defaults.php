<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class fb_defaults extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `user_family_background` (`family_background_id`, `family_background_user_id`, `family_background_m_firstname`, `family_background_m_middlename`, `family_background_m_lastname`, `family_background_m_suffix`, `family_background_f_firstname`, `family_background_f_middlename`, `family_background_f_lastname`, `family_background_f_suffix`, `family_background_g_firstname`, `family_background_g_middlename`, `family_background_g_lastname`, `family_background_g_suffix`, `family_background_g_relationship`, `family_background_number_of_siblings`, `family_background_address`, `date_created`, `date_updated`) VALUES
(1, 4, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(2, 5, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(3, 6, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(4, 7, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(5, 8, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(6, 9, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(7, 10, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(8, 11, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(9, 12, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(10, 13, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(11, 14, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(12, 15, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(13, 16, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41'),
(14, 17, 'Hanrickson', 'Etrone', 'Dumapit', NULL, 'Hanrickson', NULL, 'Dumapit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-13 00:11:41', '2023-10-13 00:11:41');");
    }
}
