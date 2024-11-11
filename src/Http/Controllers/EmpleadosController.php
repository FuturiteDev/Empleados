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

        $empleado = $this->empleados->with(['infoPuesto', 'infoNomina', 'archivos'])->find($id);

        return view('empleados::detalle', ['empleado' => $empleado]);
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
                    'id',
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
                $empleado->refresh();

                return response()->json([
                    'success' => true,
                    'message' => "Empleado registrado con éxito.",
                    'empleado' => $empleado
                ], 200);
            } else {
                $empleado = $this->empleados->create($values);

                $empleados = $this->getAll()->getData(true);
                return response()->json([
                    'success' => true,
                    'message' => "Empleado registrado con éxito.",
                    'results' => $empleados['results']
                ], 200);
            }
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

            $empleado->infoPuesto->refresh();

            return response()->json([
                'success' => true,
                'message' => "Información guardada con éxito.",
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

    /**
     * /api/empleados/saveNominaEmpleado
     *
     * Guarda un empleado
     *
     * @return JSON
     **/
    public function saveNominaEmpleado(Request $request){
        try {

            $empleado = $this->empleados->with('infoNomina')->find($request->empleado_id);
            
            $data = $request->except(['empleado_id']);
            
            if(empty($empleado->infoNomina)){
                $empleado->infoNomina()->create($data);
                $empleado->load('infoNomina');
            }else{
                $empleado->infoNomina->fill($data);
                $empleado->infoNomina->save();
            }

            $empleado->infoNomina->refresh();
            return response()->json([
                'success' => true,
                'message' => "Información guardada con éxito.",
                'infoNomina' => $empleado->infoNomina
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->saveNominaEmpleado() | " . $e->getMessage(). " | " . $e->getLine());
            
            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->saveNominaEmpleado() | " . $e->getMessage(). " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }


    /**
     * /api/empleados/saveFileEmpleado
     *
     * Guarda un empleado
     *
     * @return JSON
     **/
    public function saveFileEmpleado(Request $request){
        try {

            $validator = Validator::make($request->all(), [
                'empleado_id' => 'required',
                'categoria' => 'required',
                'slug' => 'required',
                'archivo' => 'required|file'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Datos requeridos incompletos",
                    "info" => $validator->errors(),
                ]);
            }

            $data = $request->only('categoria', 'slug');
            $empleado = $this->empleados->find($request->empleado_id);

            $path = $request->archivo->store('archivos/empleado_'.$empleado->id);
            $data['archivo'] = array(
                'nombre' => $request->archivo->getClientOriginalName(),
                'extension' => $request->archivo->getClientOriginalExtension(),
                'path' => $path
            );

            $empleado->archivos()->create($data);
            $empleado->load('archivos');
            
            return response()->json([
                'success' => true,
                'message' => "Archivo guardado con éxito.",
                'archivos' => $empleado->archivos
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->saveFileEmpleado() | " . $e->getMessage(). " | " . $e->getLine());
            
            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->saveFileEmpleado() | " . $e->getMessage(). " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }


    /**
     * /api/empleados/deleteFileEmpleado
     *
     * Guarda un empleado
     *
     * @return JSON
     **/
    public function deleteFileEmpleado(Request $request){
        try {

            $empleado = $this->empleados->find($request->empleado_id);
            $archivo = $empleado->archivos()->find($request->archivo_id);
            if($archivo){
                $archivo->estatus = 0;
                $archivo->save();
            }

            $empleado->load('archivos');
            return response()->json([
                'success' => true,
                'message' => "Archivo eliminado con éxito.",
                'archivos' => $empleado->archivos
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->deleteFileEmpleado() | " . $e->getMessage(). " | " . $e->getLine());
            
            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->deleteFileEmpleado() | " . $e->getMessage(). " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }


    /**
     * /api/empleados/getAreas
     *
     * Guarda un empleado
     *
     * @return JSON
     **/
    public function getAreas(){
        try {

            return response()->json([
                'success' => true,
                'results' => $this->areas->findByField('estatus', 1)
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->getAreas() | " . $e->getMessage(). " | " . $e->getLine());
            
            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->getAreas() | " . $e->getMessage(). " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }

    /**
     * /api/empleados/getPuestos
     *
     * Guarda un empleado
     *
     * @return JSON
     **/
    public function getPuestos(){
        try {

            return response()->json([
                'success' => true,
                'results' => $this->puestos->findByField('estatus', 1)
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->getPuestos() | " . $e->getMessage(). " | " . $e->getLine());
            
            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->getPuestos() | " . $e->getMessage(). " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }

}
