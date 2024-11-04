<?php

namespace Ongoing\Empleados\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Ongoing\Empleados\Repositories\PuestosRepository;
use Ongoing\Empleados\Entities\Puesto;


/**
 * Class PuestoRepositoryEloquent.
 *
 * @package namespace Ongoing\Empleados\Repositories;
 */
class PuestosRepositoryEloquent extends BaseRepository implements PuestosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Puesto::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
