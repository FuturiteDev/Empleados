<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Ongoing\Empleados\Repositories\EmpleadoNominaRepository;
use Ongoing\Empleados\Entities\EmpleadoNomina;
use Ongoing\Empleados\Validators\EmpleadoNominaValidator;

/**
 * Class EmpleadoNominaRepositoryEloquent.
 *
 * @package namespace Ongoing\Empleados\Repositories;
 */
class EmpleadoNominaRepositoryEloquent extends BaseRepository implements EmpleadoNominaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmpleadoNomina::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
