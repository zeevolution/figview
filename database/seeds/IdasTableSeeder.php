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
        \Figview\Models\Idas::truncate();
        factory(\Figview\Models\Idas::class, 10)->create();
    }
}
