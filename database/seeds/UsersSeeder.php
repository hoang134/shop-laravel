<?php

use Illuminate\Database\Seeder;
use App\Helpers\Constant;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'role' => User::ROLE_ADMIN,
            'status' => Constant::STATUS_ACTIVE,
        ]);
    }
}
