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
		Schema::create('empleados', function(Blueprint $table) {
            $table->id();
            $table->string('no_empleado', 10)->nullable();
			$table->string('nombre');
            $table->string('apellidos');
            $table->string('alias')->nullable();
			$table->string('rfc')->nullable();
			$table->string('curp')->nullable();
			$table->string('ine')->nullable();
			$table->string('nss')->nullable();
			$table->text('domicilio_ine')->nullable();
			$table->text('domicilio_actual')->nullable();
			$table->text('domicilio_fiscal')->nullable();
			$table->string('telefono')->nullable();
			$table->string('celular')->nullable();
			$table->string('email')->nullable();
			$table->string('email_trabajo')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_alta_imss')->nullable();
			$table->tinyInteger('estatus')->default(1);
            $table->timestamps();
			
			$table->engine = 'InnoDB';
			$table->index('no_empleado');
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
