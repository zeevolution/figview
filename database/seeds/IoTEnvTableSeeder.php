<?php

use Illuminate\Database\Seeder;

class IoTEnvTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(\Figview\Entities\IotEnv::class, 10)->create();
    }
}
