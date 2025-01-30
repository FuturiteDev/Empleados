<?php

namespace Ongoing\Empleados\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Ongoing\Empleados\Repositories\EmpleadosAsistenciaRepository;
use Ongoing\Empleados\Entities\EmpleadosAsistencia;
use App\Validators\EmpleadosAsistenciaValidator;

/**
 * Class EmpleadosAsistenciaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmpleadosAsistenciaRepositoryEloquent extends BaseRepository implements EmpleadosAsistenciaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmpleadosAsistencia::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
