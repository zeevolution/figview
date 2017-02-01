<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIoTEnvMembersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('io_t_env_members', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('iotenv_id')->unsigned();
            $table->foreign('iotenv_id')->references('id')->on('iot_envs');
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('users');

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
		Schema::drop('io_t_env_members');
	}

}
