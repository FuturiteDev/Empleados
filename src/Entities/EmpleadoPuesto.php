<?php

namespace Ongoing\Empleados\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

use Ongoing\Sucursales\Entities\Sucursales;

/**
 * Class EmpleadoPuesto.
 *
 * @package namespace Ongoing\Empleados\Entities;
 */
class EmpleadoPuesto extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'empleado_puesto';

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

    protected $with = ['area', 'puesto', 'sucursal', 'jefe'];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function puesto(){
        return $this->belongsTo(Puesto::class);
    }

    public function sucursal(){
        return $this->belongsTo(Sucursales::class);
    }

    public function jefe(){
        return $this->belongsTo(Empleado::class, 'jefe_id', 'id')->select("id", "no_empleado", "nombre", "apellidos", "alias");
    }

}
