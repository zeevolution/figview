<?php

use Illuminate\Database\Seeder;

class IdasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Figview\Idas::truncate();
        factory(\Figview\Idas::class, 10)->create();
    }
}
