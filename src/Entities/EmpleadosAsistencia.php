<?php

namespace Ongoing\Empleados\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use Ongoing\Empleados\Entities\Empleado;
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

    protected $fillable = ['empleado_id', 'fecha', 'hora'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

}
