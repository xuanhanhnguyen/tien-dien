<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@admin.com',
            'phone' => '0987654321',
            'name' => 'Admin',
            'role' => 'admin',
            'password' => bcrypt('admin@123')
        ]);

        User::create([
            'email' => 'shane@laraspace.in',
            'phone' => '0956784321',
            'name' => 'Shane White',
            'role' => 'user',
            'password' => bcrypt('hank@123')
        ]);

        User::create([
            'email' => 'adam@laraspace.in',
            'phone' => '0934567218',
            'name' => 'Adam David',
            'role' => 'user',
            'password' => bcrypt('jesse@123')
        ]);
    }
}
