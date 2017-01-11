<?php

use Illuminate\Database\Seeder;

class OrionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Figview\Orion::truncate();
        factory(\Figview\Orion::class, 10)->create();
    }
}
