<?php

namespace Ongoing\Empleados\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Ongoing\Empleados\Repositories\EmpleadoPuestoRepository;
use Ongoing\Empleados\Entities\EmpleadoPuesto;
use Ongoing\Empleados\Validators\EmpleadoPuestoValidator;

/**
 * Class EmpleadoPuestoRepositoryEloquent.
 *
 * @package namespace Ongoing\Empleados\Repositories;
 */
class EmpleadoPuestoRepositoryEloquent extends BaseRepository implements EmpleadoPuestoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmpleadoPuesto::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
