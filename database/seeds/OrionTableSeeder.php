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
        \Figview\Models\Orion::truncate();
        factory(\Figview\Models\Orion::class, 10)->create();
    }
}
