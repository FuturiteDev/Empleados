<?php

namespace Ongoing\Empleados\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Log;

use Ongoing\Empleados\Repositories\EmpleadosRepositoryEloquent;



class EmpleadosController extends Controller
{
    protected $empleados;

    public function __construct(
        EmpleadosRepositoryEloquent $empleados
    ) {
        $this->empleados = $empleados;
    }
    
    function index() {
        $empleados = $this->getAll();
        return view('empleados::listado', ['empleados' => $empleados]);
    }

    public function detalle($id) {
        return view('empleados::detalle');
    }

    public function getAll(){
        try {
            $empleados = $this->empleados->where(['estatus' => 1])->get();

            return response()->json([
                'status' => true,
                'results' => $empleados
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->getAll() | " . $e->getMessage(). " | " . $e->getLine());
            
            return response()->json([
                'status' => false,
                'message' => "[ERROR] EmpleadosController->getAll() | " . $e->getMessage(). " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }

    /**
     * /api/sucursales/save
     *
     * Guarda una sucursal
     *
     * @return JSON
     **/
    public function save(Request $request){
        try {

            $values = $request->only(['nombre', 'direccion']);
            $values['estatus'] = 1;

            $nombreExistente = $this->empleados->where('nombre', $values['nombre'])
                ->where('estatus', 1)
                ->where('id', '!=', $request->sucursal_id)
                ->exists();

            if ($nombreExistente) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ya existe una sucursal activa con ese nombre.',
                    'results' => null
                ], 400);
            }

            if ($request->sucursal_id) {
                $sucursal = $this->empleados->find($request->sucursal_id);
                if (!$sucursal) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Sucursal no encontrada.',
                        'results' => null
                    ], 404);
                }
                $sucursal->update($values);
            } else {
                $sucursal = $this->empleados->create($values);
            }
            return response()->json([
                'status' => true,
                'message' => "Sucursal guardada.",
                'results' => $this->empleados->where(['estatus' => 1])->get()
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->save() | " . $e->getMessage(). " | " . $e->getLine());
            
            return response()->json([
                'status' => false,
                'message' => "[ERROR] EmpleadosController->save() | " . $e->getMessage(). " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }

    /**
     * /api/sucursales/delete
     *
     * Deshabilita una sucursal
     *
     * @return JSON
     **/
    public function delete(Request $request)
    {
        try {

            $this->empleados->where('id', $request->sucursal_id)->update(['estatus' => 0]);

            return response()->json([
                'status' => true,
                'message' => "Sucursal eliminada.",
                'results' => $this->empleados->where('estatus', 1)->get()
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->delete() | " . $e->getMessage() . " | " . $e->getLine());
            return response()->json([
                'status' => false,
                'message' => "[ERROR] EmpleadosController->delete() | " . $e->getMessage() . " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }
}
