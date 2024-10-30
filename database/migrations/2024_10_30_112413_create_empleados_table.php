<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		dd('dont migrate');
		Schema::create('empleados', function(Blueprint $table) {
            $table->increments('id');
			$table->string('nombre');
            $table->text('direccion')->nullable();
            $table->tinyInteger('estatus')->default(0);
            $table->timestamps();
			
			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empleados');
	}
};
