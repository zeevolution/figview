<?php

use Illuminate\Database\Seeder;

class DeviceModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Figview\Entities\DeviceModel::class, 1)->create([
            'name' => 'SENSOR_TEMP',
            'model' => '{ "devices": [ { "device_id": "DEV_ID", "entity_name": "ENTITY_ID", "entity_type": "thing", "timezone": "Europe/Madrid", "attributes": [ { "object_id": "t", "name": "temperature", "type": "int" } ], "static_attributes": [ { "name": "att_name", "type": "string", "value": "value" } ] }]}',
            'iotenv_id' => rand(1, 10),
        ]);

        factory(\Figview\Entities\DeviceModel::class, 10)->create();
    }
}
