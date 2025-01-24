<?php

namespace Ongoing\Empleados\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use Ongoing\Empleados\Entities\Empleado;
use Ongoing\Sucursales\Entities\Sucursales;

/**
 * Class EmpleadosAsistencia.
 *
 * @package namespace App\Entities;
 */
class EmpleadosAsistencia extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'empleado_asistencias';

    protected $fillable = ['empleado_id', 'sucursal_id', 'fecha', 'hora', 'motivo', 'imagen'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'sucursal_id');
    }

    public function getMotivoDescAttribute()
    {
        if (!is_null($this->motivo)) {
            switch ($this->motivo) {
                case 0:
                    return 'Entrada';
                case 1:
                    return 'Salida';
                default:
                    return '-';
            }
        }

        return '-';
    }
}
