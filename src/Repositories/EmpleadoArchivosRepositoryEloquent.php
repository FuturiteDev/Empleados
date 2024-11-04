<?php

namespace Ongoing\Empleados\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Ongoing\Empleados\Repositories\EmpleadoArchivosRepository;
use Ongoing\Empleados\Entities\EmpleadoArchivos;
use Ongoing\Empleados\Validators\EmpleadoArchivosValidator;

/**
 * Class EmpleadoArchivosRepositoryEloquent.
 *
 * @package namespace Ongoing\Empleados\Repositories;
 */
class EmpleadoArchivosRepositoryEloquent extends BaseRepository implements EmpleadoArchivosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmpleadoArchivos::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
