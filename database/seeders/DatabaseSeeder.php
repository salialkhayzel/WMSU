<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call([
            userRoles::class,
            statusSeeder::class,
            userGenders::class,
            userSex::class,
            userStatus::class,
            schoolTypes::class,
            usersDefault::class,
            moduleList::class,
            testTypes::class,
            schoolYears::class,
            testStatus::class,
            cet_type_lists::class,
            fb_defaults::class,
            test_samples::class,
            Rooms_sample::class,
            admin_role_names::class,
            admin_role::class,
            access_role::class,
            statusesSeeder::class,
            carousel_seeders::class,
            servicesSeeder::class,
            aboutusSeeder::class,
            examSeeders::class,
            collegeSeeders::class,
            campus_seeder::class,
            high_school_seeders::class,
            test_centers_seeders::class,
            regions_seeders::class,
            province_seeders::class,
            city_mun_seeders::class,
            test_schedules_seeders::class,
            notication_icons::class,
            brgy_seeders::class,
      
        ]);
        
    }
}
