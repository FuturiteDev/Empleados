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
        return $this->hasMany(EmpleadoArchivos::class)->where('estatus', 1);
    }

    public function asistencias()
    {
        return $this->hasMany(EmpleadosAsistencia::class);
    }

    public function jefe()
    {
        return $this->hasOneThrough(
            Empleado::class,         // Modelo relacionado directamente (el jefe)
            EmpleadoPuesto::class,   // Modelo intermedio (relación empleado-puesto)
            'empleado_id',           // Llave foránea en `empleado_puesto` que relaciona con `empleado`
            'id',                    // Llave primaria en `empleado` (el jefe)
            'id',                    // Llave primaria en `empleado` (el empleado actual)
            'jefe_id'                // Llave foránea en `empleado_puesto` que relaciona con el jefe
        )
        ->select([
            'empleados.id',
            'empleados.no_empleado',
            'empleados.email',
            'empleados.nombre',
            'empleados.apellidos',
            'empleados.alias',
            'empleados.email',
        ]);
    }
}
