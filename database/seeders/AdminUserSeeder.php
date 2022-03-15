<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('12345678');
        $admin_user = [
            ['name' => 'Admin', 'email' => 'mail@ceytechsystem.com', 'password' => $password, 'roll_id' => 1, 'id' => 1],
        ];

        $privillege_user = [
            ['privilege_id' => 1, 'user_id' => 1, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1, 'id' => 1],
            ['privilege_id' => 2, 'user_id' => 1, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1, 'id' => 2],
            ['privilege_id' => 3, 'user_id' => 1, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1, 'id' => 3],
        ];

        \DB::table('users')->insert($admin_user);
        \DB::table('privilege_user')->insert($privillege_user);
    }
}
