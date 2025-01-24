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
		Schema::create('empleado_asistencias', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedBigInteger('empleado_id');
        	$table->unsignedInteger('sucursal_id'); 
			$table->date('fecha');
			$table->time('hora');
			$table->integer('motivo')->nullable();
			$table->string('imagen')->nullable();
			$table->timestamps();
		
			$table->engine = 'InnoDB';
		
			$table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('restrict');
			$table->foreign('sucursal_id')->references('id')->on('sucursales')->onDelete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empleados_asistencias');
	}
};
