<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_nomina', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->decimal('sueldo_mensual_neto', 8,2)->nullable();
            $table->decimal('sueldo_mensual_bruto', 8,2)->nullable();
            $table->decimal('sueldo_mensual_efectivo', 8,2)->nullable();
            $table->decimal('sueldo_quincenal_neto', 8,2)->nullable();
            $table->decimal('sueldo_quincena1_efectivo', 8,2)->nullable();
            $table->decimal('sueldo_quincena2_efectivo', 8,2)->nullable();
            $table->decimal('sueldo_diario', 8,2)->nullable();
            $table->decimal('sueldo_diario_integrado', 8,2)->nullable();
            $table->decimal('gasto_nomina', 8,2)->nullable();
            $table->decimal('gasto_patronal', 8,2)->nullable();

            $table->decimal('pres_vehiculo', 8,2)->nullable();
            $table->decimal('pres_gasolina', 8,2)->nullable();
            $table->decimal('pres_celular', 8,2)->nullable();
            $table->decimal('pres_alimentos', 8,2)->nullable();
            $table->decimal('pres_seguro_medico_menor', 8,2)->nullable();
            $table->decimal('pres_cursos_profesional', 8,2)->nullable();
            $table->decimal('pres_cursos_personal', 8,2)->nullable();
            $table->decimal('pres_otros', 8,2)->nullable();


            $table->timestamps();

            $table->engine = 'InnoDB';

            $table->foreign('empleado_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado_nomina');
    }
}
