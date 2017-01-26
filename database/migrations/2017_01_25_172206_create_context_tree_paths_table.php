<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContextTreePathsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('context_tree_paths', function(Blueprint $table) {
			$table->integer('ancestor')->unsigned();
            $table->integer('descendant')->unsigned();
            $table->primary(array('ancestor', 'descendant'));
            $table->foreign('ancestor')->references('id')->on('iot_envs');
            $table->foreign('descendant')->references('id')->on('iot_envs');

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
		Schema::drop('context_tree_paths');
	}

}
