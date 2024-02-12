<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersDefault extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::statement('INSERT INTO `users` (`user_id`, `user_status_id`, `user_sex_id`, `user_gender_id`, `user_role_id`, `user_name`, `user_email`, `user_phone`, `user_password`, `user_name_verified`, `user_email_verified`, `user_phone_verified`, `user_firstname`, `user_middlename`, `user_lastname`, `user_suffix`, `user_birthdate`, `user_profile_picture`, `user_formal_id`, `date_created`, `date_updated`) VALUES
(1, 1, 1, 2, 2, "Drusha01", "bg201802518@wmsu.edu.ph", "0926582734", "$argon2i$v=19$m=65536,t=4,p=1$OVJtVVc1ekFuM3dvaFdmOQ$iNUguAwgn27AXcv4Onu57l1uUlnMpwbIQhtaSY7A15o", 1, 1, 0, "Hanricksonsadf", "Etrone", "Dumapit", "jr", "2000-08-31", "default.png", "default.png", "2023-09-28 13:36:19", "2023-10-02 21:17:47"),
(2, 1, 1, 1, 1, "mate04", "mattalbertluna@gmail.com", "0936519205", "$argon2i$v=19$m=65536,t=4,p=1$QnF5Qzg0UllHeWl0QTlBcw$dZgxescXNjYZToLGmU3r910SQzpVKogbEgA6SnLFHjA", 1, 1, 0, "matt albert", "sumampong", "luna", "",  "2002-04-04", "default.png", "default.png", "2023-09-28 13:41:53", "2023-09-28 14:01:52"),
(3, 1, 1, 1, 1, "kaikai123", "gt201901721@wmsu.edu.ph", NULL, "$argon2i$v=19$m=65536,t=4,p=1$SXhFNmxHNHJsZ0FtYi51RQ$cPmh1vH48fDXn6123ZcAID3Q8EHAq6BYKbpXNPb4mN8", 1, 1, 0, "Al-kaikai", "Abdilla", "Sali", "N/A", "2000-02-08", "default.png", "default.png", "2023-09-28 16:28:48", "2023-09-28 16:28:48"),
(4, 1, 1, 1, 1, "Drusha02", "drusha2@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Charity", "", "Emmanuel", "",  "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(5, 1, 1, 1, 1, "Drusha03", "drusha3@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Sidrick", "E", "Cadungog", "",  "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(6, 1, 1, 1, 1, "Drusha04", "drusha4@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Abdar", "", "Talib", "",  "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(7, 1, 1, 1, 1, "Drusha05", "drusha5@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Bushra", "", "Adjaluddin", "",  "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(8, 1, 1, 1, 1, "Drusha06", "drusha06@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Hazel Claire", "B", "Alidon", "", "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(9, 1, 1, 1, 1, "Drusha07", "drusha07@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Betty Jane", "", "Guererro", "",  "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(10, 1, 1, 1, 1, "Drusha08", "drusha08@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Sherinata", "", "Said", "",  "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(11, 1, 1, 1, 1, "Drusha09", "drusha09@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Drusha", "G", "Tipamood", "",  "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(12, 1, 1, 1, 1, "Drusha010", "drusha010@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "John Kent", "Adlawan", "Evangelista", "",  "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(13, 1, 1, 1, 1, "Drusha011", "drusha011@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Bryan Christian", "", "Sevilla", "",  "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(14, 1, 1, 1, 1, "Drusha012", "drusha012@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Khasmir", "", "Bassaluddin", "", "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(15, 1, 1, 1, 1, "Drusha013", "drusha013@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Matt", "", "Albert", "",  "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(16, 1, 1, 1, 1, "Drusha014", "drusha014@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Steffi", "E", "Wong", "",  "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15"),
(17, 1, 1, 1, 1, "Drusha015", "drusha015@gmail.com", NULL, "$argon2i$v=19$m=65536,t=4,p=1$TDhxQnBxRkJ5cHlTQkxHcA$giflgEB2QqDiN6zvLI6cmsz2Qpii79fyEI8oeJ/iTIg", 1, 1, 0, "Faye", "", "Lacsi", "", "2000-08-31", "default.png", "default.png", "2023-10-02 22:00:15", "2023-10-02 22:00:15")
;');
    }
}
