<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEmpleadoNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleado_nomina', function (Blueprint $table) {
            $table->decimal('pres_prima_vacacional',8,2)->nullable()->after('gasto_patronal');
            $table->decimal('pres_aguinaldo',8,2)->nullable()->after('pres_prima_vacacional');
            $table->decimal('pres_ptu',8,2)->nullable()->after('pres_aguinaldo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleado_nomina', function (Blueprint $table) {
            $table->dropColumn('pres_prima_vacacional');
            $table->dropColumn('pres_aguinaldo');
            $table->dropColumn('pres_ptu');
        });
    }
}
