<?php

namespace Ongoing\Empleados\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Ongoing\Empleados\Repositories\AreasRepository;
use Ongoing\Empleados\Entities\Area;


/**
 * Class AreasRepositoryEloquent.
 *
 * @package namespace Ongoing\Empleados\Repositories;
 */
class AreasRepositoryEloquent extends BaseRepository implements AreasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Area::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
