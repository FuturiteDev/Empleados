<?php

namespace Ongoing\Empleados\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Empleado.
 *
 * @package namespace Ongoing\Empleados\Entities;
 */
class Empleado extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_empleado',
        'nombre',
        'apellidos',
        'alias',
        'rfc',
        'curp',
        'ine',
        'nss',
        'domicilio_ine',
        'domicilio_actual',
        'domicilio_fiscal',
        'telefono',
        'celular',
        'email',
        'email_trabajo',
        'fecha_nacimiento',
        'fecha_ingreso',
        'fecha_alta_imss',
    ];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['nombre_completo'];

    
    public function getNombreCompletoAttribute(){
        return $this->nombre . ' ' . $this->apellidos;
    }

    public function infoPuesto(){
        return $this->hasOne(EmpleadoPuesto::class);
    }

    public function infoNomina(){
        return $this->hasOne(EmpleadoNomina::class);
    }

    public function archivos(){
        return $this->hasMany(Empleadoarchivos::class)->where('estatus', 1);
    }
}
