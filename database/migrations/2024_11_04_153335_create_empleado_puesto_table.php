<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoPuestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_puesto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedInteger('area_id')->nullable();
            $table->unsignedInteger('puesto_id')->nullable();
            $table->unsignedBigInteger('jefe_id')->nullable();
            $table->unsignedInteger('sucursal_id')->nullable();
            $table->text('horario')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';

            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->foreign('jefe_id')->references('id')->on('empleados');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('puesto_id')->references('id')->on('puestos');
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado_puesto');
    }
}
