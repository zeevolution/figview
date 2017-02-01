<?php

use Illuminate\Database\Seeder;

class IoTEnvMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Figview\Entities\IoTEnvMember::class, 10)->create();
    }
}
