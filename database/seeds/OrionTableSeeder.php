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
        \Figview\Entities\Orion::truncate();
        factory(\Figview\Entities\Orion::class, 10)->create();
    }
}
