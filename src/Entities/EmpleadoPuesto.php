<?php

namespace Ongoing\Empleados\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

/**
 * Class EmpleadoPuesto.
 *
 * @package namespace Ongoing\Empleados\Entities;
 */
class EmpleadoPuesto extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empleado_id',
        'area_id',
        'puesto_id',
        'jefe_id',
        'sucursal_id',
        'horario',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'horario' => AsArrayObject::class
    ];

}
