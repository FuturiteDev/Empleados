<?php

namespace Ongoing\Empleados\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Ongoing\Empleados\Repositories\EmpleadosRepository;
use Ongoing\Empleados\Entities\Empleado;


/**
 * Class EmpleadosRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmpleadosRepositoryEloquent extends BaseRepository implements EmpleadosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Empleado::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
