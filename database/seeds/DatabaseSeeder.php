<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Supprt\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('userroles')->insert([
            [
                'RoleName' => 'Administrator',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'RoleName' => 'Student',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'RoleName' => 'Librarian',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'RoleName' => 'Teacher',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        DB::table('users')->insert([
            [
                'FirstName' => 'Admin',
                'SecondName' => 'Sudo',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin@123'),
                'UserRole' => 1,
                'Obfuscator' => substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 25)), 0, 5),
                'validity' => 1,
                'gender' => 'Female',
                'title' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('titles')->insert([
            [
                'TitleName' => 'Mr.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'TitleName' => 'Mrs.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'TitleName' => 'Ms.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
