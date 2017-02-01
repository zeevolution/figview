<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //\Figview\Entities\Idas::truncate();
        //\Figview\Entities\IotEnv::truncate();
        //\Figview\Entities\Orion::truncate();

        $this->call(UserTableSeeder::class);
        $this->call(OrionTableSeeder::class);
        $this->call(IdasTableSeeder::class);
        $this->call(IoTEnvTableSeeder::class);
        $this->call(ContextTreePathTableSeeder::class);
        $this->call(DeviceModelTableSeeder::class);
        $this->call(IoTEnvMemberTableSeeder::class);

        Model::reguard();
    }
}
