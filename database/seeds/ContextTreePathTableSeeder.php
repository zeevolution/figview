<?php

use Illuminate\Database\Seeder;

class ContextTreePathTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Figview\Entities\ContextTreePath::class, 5)->create();
    }
}
