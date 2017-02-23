<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIotEnvsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('iot_envs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->string('Fiware_Service');
			$table->string('content_type');
			$table->string('Fiware_ServicePath');
			$table->string('X_Auth_Token');
			$table->integer('orion_id')->unsigned();
			$table->foreign('orion_id')->references('id')->on('orions');
            $table->integer('idas_id')->unsigned();
            $table->foreign('idas_id')->references('id')->on('idas');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('iot_envs');
	}

}
