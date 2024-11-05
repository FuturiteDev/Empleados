<?php

namespace Ongoing\Empleados\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

/**
 * Class EmpleadoArchivos.
 *
 * @package namespace Ongoing\Empleados\Entities;
 */
class EmpleadoArchivos extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empleado_id',
        'categoria',
        'slug',
        'archivo',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'archivo' => AsArrayObject::class
    ];
}
