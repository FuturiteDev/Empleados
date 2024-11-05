<?php

namespace Ongoing\Empleados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Log;

use Ongoing\Empleados\Repositories\EmpleadosRepositoryEloquent;
use Ongoing\Empleados\Repositories\AreasRepositoryEloquent;
use Ongoing\Empleados\Repositories\PuestosRepositoryEloquent;



class EmpleadosController extends Controller
{
    protected $empleados;
    protected $areas;
    protected $puestos;

    public function __construct(
        EmpleadosRepositoryEloquent $empleados,
        AreasRepositoryEloquent $areas,
        PuestosRepositoryEloquent $puestos
    ) {
        $this->empleados = $empleados;
        $this->areas = $areas;
        $this->puestos = $puestos;
    }
    
    function index() {
        Gate::authorize('access-granted', '/empleados');
        $empleados = $this->getAll()->getData(true);
        return view('empleados::listado', ['empleados' => $empleados['results']]);
    }

    public function detalle($id) {
        return view('empleados::detalle');
    }

    /**
     * Lista de empleados activos
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getAll(){
        try {
            $empleados = $this->empleados->findWhere(
                ['estatus' => 1], 
                [
                    'no_empleado',
                    'nombre',
                    'apellidos',
                    'alias',
                    'rfc',
                    'nss',
                    'domicilio_ine',
                    'domicilio_actual',
                    'telefono',
                    'celular',
                    'email',
                    'email_trabajo',
                    'fecha_ingreso',
                ]
            );

            return response()->json([
                'success' => true,
                'results' => $empleados
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->getAll() | " . $e->getMessage(). " | " . $e->getLine());
            
            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->getAll() | " . $e->getMessage(). " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }

    /**
     * /api/empleados/saveEmpleado
     *
     * Guarda un empleado
     *
     * @return JSON
     **/
    public function saveEmpleado(Request $request){
        try {

            
            // Validaciones
            $validator = Validator::make($request->all(), [
                'no_empleado' => 'required',
                'nombre' => 'required',
                'apellidos' => 'required'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Datos requeridos incompletos",
                    "info" => $validator->errors(),
                ]);
            }
            
            $values = $request->except(['id']);

            $empleadoExistente = $this->empleados->where('no_empleado', $values['no_empleado'])
                ->where('estatus', 1)
                ->where('id', '!=', $request->id)
                ->exists();

            if ($empleadoExistente) {
                return response()->json([
                    'success' => false,
                    'message' => 'El número de empleado ya se encuentra en uso.'
                ]);
            }

            if ($request->id) {
                $empleado = $this->empleados->find($request->id);
                $empleado->update($values);
            } else {
                $empleado = $this->empleados->create($values);
            }

            $empleados = $this->getAll()->getData(true);
            return response()->json([
                'success' => true,
                'message' => "Empleado guardado.",
                'results' => $empleados['results']
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->saveEmpleado() | " . $e->getMessage(). " | " . $e->getLine());
            
            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->saveEmpleado() | " . $e->getMessage(). " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }

    /**
     * /api/empleados/delete
     *
     * Deshabilita un empleado
     *
     * @return JSON
     **/
    public function delete(Request $request)
    {
        try {

            $empleado = $this->empleados->find($request->empleado_id);
            $empleado->estatus = 0;
            $empleado->save();

            $empleados = $this->getAll()->getData(true);

            return response()->json([
                'success' => true,
                'message' => "Empleado eliminado.",
                'empleados' => $empleados['results']
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->delete() | " . $e->getMessage() . " | " . $e->getLine());
            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->delete() | " . $e->getMessage() . " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }


    /**
     * /api/empleados/savePuestoEmpleado
     *
     * Guarda un empleado
     *
     * @return JSON
     **/
    public function savePuestoEmpleado(Request $request){
        try {

            $empleado = $this->empleados->with('infoPuesto')->find($request->empleado_id);
            
            $data = [
                'area_id' => null,
                'puesto_id' => null,
                'jefe_id' => $request->jefe_id,
                'sucursal_id' => $request->sucursal_id,
                'horario' => $request->horario ?? [],
            ];

            if($request->area_id){
                $data['area_id'] = $request->area_id;
            }elseif($request->area){
                $area = $this->areas->firstOrCreate(['nombre' => $request->area]);
                $data['area_id'] = $area->id;
            }

            if($request->puesto_id){
                $data['puesto_id'] = $request->puesto_id;
            }elseif($request->puesto){
                $puesto = $this->puestos->firstOrCreate(['nombre' => $request->puesto]);
                $data['puesto_id'] = $puesto->id;
            }
            
            if(empty($empleado->infoPuesto)){
                $empleado->infoPuesto()->create($data);
                $empleado->load('infoPuesto');
            }else{
                $empleado->infoPuesto->fill($data);
                $empleado->infoPuesto->save();
            }

            return response()->json([
                'success' => true,
                'message' => "Empleado guardado.",
                'infoPuesto' => $empleado->infoPuesto
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->savePuestoEmpleado() | " . $e->getMessage(). " | " . $e->getLine());
            
            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->savePuestoEmpleado() | " . $e->getMessage(). " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }


}
