<?php

namespace Ongoing\Empleados\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EmpleadoNomina.
 *
 * @package namespace Ongoing\Empleados\Entities;
 */
class EmpleadoNomina extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "empleado_nomina";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empleado_id',
        'sueldo_mensual_neto',
        'sueldo_mensual_bruto',
        'sueldo_mensual_efectivo',
        'sueldo_quincenal_neto',
        'sueldo_quincena1_efectivo',
        'sueldo_quincena2_efectivo',
        'sueldo_diario',
        'sueldo_diario_integrado',
        'gasto_nomina',
        'gasto_patronal',
        'pres_vehiculo',
        'pres_gasolina',
        'pres_celular',
        'pres_alimentos',
        'pres_seguro_medico_menor',
        'pres_cursos_profesional',
        'pres_cursos_personal',
        'pres_otros',
    ];

}
