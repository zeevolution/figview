<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceModelsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('device_models', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->json('model');
			$table->integer('iotenv_id')->unsigned();
			$table->foreign('iotenv_id')->references('id')->on('iot_envs');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('device_models');
	}

}
