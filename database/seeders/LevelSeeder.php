<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = [
            ['name' => 'level_one', 'value' => 1, 'id' => 1],
        ];
        \DB::table('levels')->insert($level);//
    }
}
