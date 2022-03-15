<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RollSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $roll = [
            ['name' => 'Admin', 'level_id' => 1, 'id' => 1],
        ];
        \DB::table('rolls')->insert($roll);
    }

}
