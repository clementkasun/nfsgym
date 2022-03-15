<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemAccessPrivillageSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $privileges = [
            ['id' => 1, 'name' => 'is_admin'],
            ['id' => 2, 'name' => 'reg_emp'],
            ['id' => 3, 'name' => 'send_sms']
        ];

        \DB::table('privileges')->insert($privileges);
    }
}
