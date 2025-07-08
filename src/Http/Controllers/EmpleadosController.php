<?php

namespace Ongoing\Empleados\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Log;

use Ongoing\Empleados\Repositories\EmpleadosRepositoryEloquent;
use Ongoing\Empleados\Repositories\AreasRepositoryEloquent;
use Ongoing\Empleados\Repositories\EmpleadosAsistenciaRepositoryEloquent;
use Ongoing\Empleados\Repositories\PuestosRepositoryEloquent;
use Ongoing\Sucursales\Entities\Sucursales;
use Ongoing\Sucursales\Repositories\SucursalesRepositoryEloquent;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class EmpleadosController extends Controller
{
    protected $empleados;
    protected $areas;
    protected $puestos;
    protected $asistencia;
    protected $sucursales;

    public function __construct(
        EmpleadosRepositoryEloquent $empleados,
        AreasRepositoryEloquent $areas,
        PuestosRepositoryEloquent $puestos,
        EmpleadosAsistenciaRepositoryEloquent $asistencia,
        SucursalesRepositoryEloquent $sucursales
    ) {
        $this->empleados = $empleados;
        $this->areas = $areas;
        $this->puestos = $puestos;
        $this->asistencia = $asistencia;
        $this->sucursales = $sucursales;
    }

    function index()
    {
        Gate::authorize('access-granted', '/empleados');
        $empleados = $this->getAll()->getData(true);
        return view('empleados::listado', ['empleados' => $empleados['results']]);
    }

    public function detalle($id)
    {

        $empleado = $this->empleados->with(['infoPuesto', 'infoNomina', 'archivos'])->find($id);

        return view('empleados::detalle', ['empleado' => $empleado]);
    }

    function asistencias()
    {
        Gate::authorize('access-granted', '/empleados');
        $empleados = $this->getAll()->getData(true);
        return view('empleados::asistencias', ['empleados' => $empleados['results']]);
    }

    /**
     * Lista de empleados activos
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
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
            Log::info("EmpleadosController->getAll() | " . $e->getMessage() . " | " . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->getAll() | " . $e->getMessage() . " | " . $e->getLine(),
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
    public function saveEmpleado(Request $request)
    {
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
            Log::info("EmpleadosController->saveEmpleado() | " . $e->getMessage() . " | " . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->saveEmpleado() | " . $e->getMessage() . " | " . $e->getLine(),
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
    public function savePuestoEmpleado(Request $request)
    {
        try {

            $empleado = $this->empleados->with('infoPuesto')->find($request->empleado_id);

            $data = [
                'area_id' => null,
                'puesto_id' => null,
                'jefe_id' => $request->jefe_id,
                'sucursal_id' => $request->sucursal_id,
                'horario' => $request->horario ?? [],
            ];

            if ($request->area_id) {
                $data['area_id'] = $request->area_id;
            } elseif ($request->area) {
                $area = $this->areas->firstOrCreate(['nombre' => $request->area]);
                $data['area_id'] = $area->id;
            }

            if ($request->puesto_id) {
                $data['puesto_id'] = $request->puesto_id;
            } elseif ($request->puesto) {
                $puesto = $this->puestos->firstOrCreate(['nombre' => $request->puesto]);
                $data['puesto_id'] = $puesto->id;
            }

            if (empty($empleado->infoPuesto)) {
                $empleado->infoPuesto()->create($data);
                $empleado->load('infoPuesto');
            } else {
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
            Log::info("EmpleadosController->savePuestoEmpleado() | " . $e->getMessage() . " | " . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->savePuestoEmpleado() | " . $e->getMessage() . " | " . $e->getLine(),
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
    public function saveNominaEmpleado(Request $request)
    {
        try {

            $empleado = $this->empleados->with('infoNomina')->find($request->empleado_id);

            $data = $request->except(['empleado_id']);

            if (empty($empleado->infoNomina)) {
                $empleado->infoNomina()->create($data);
                $empleado->load('infoNomina');
            } else {
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
            Log::info("EmpleadosController->saveNominaEmpleado() | " . $e->getMessage() . " | " . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->saveNominaEmpleado() | " . $e->getMessage() . " | " . $e->getLine(),
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
    public function saveFileEmpleado(Request $request)
    {
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

            $path = $request->archivo->store('archivos/empleado_' . $empleado->id);
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
            Log::info("EmpleadosController->saveFileEmpleado() | " . $e->getMessage() . " | " . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->saveFileEmpleado() | " . $e->getMessage() . " | " . $e->getLine(),
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
    public function deleteFileEmpleado(Request $request)
    {
        try {

            $empleado = $this->empleados->find($request->empleado_id);
            $archivo = $empleado->archivos()->find($request->archivo_id);
            if ($archivo) {
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
            Log::info("EmpleadosController->deleteFileEmpleado() | " . $e->getMessage() . " | " . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->deleteFileEmpleado() | " . $e->getMessage() . " | " . $e->getLine(),
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
    public function getAreas()
    {
        try {

            return response()->json([
                'success' => true,
                'results' => $this->areas->findByField('estatus', 1)
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->getAreas() | " . $e->getMessage() . " | " . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->getAreas() | " . $e->getMessage() . " | " . $e->getLine(),
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
    public function getPuestos()
    {
        try {

            return response()->json([
                'success' => true,
                'results' => $this->puestos->findByField('estatus', 1)
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->getPuestos() | " . $e->getMessage() . " | " . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->getPuestos() | " . $e->getMessage() . " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }


    /**
     * Summary of getEmpleadoNo
     * @param mixed $no_empleado
     * @return mixed
     */
    public function getEmpleadoNo($no_empleado)
    {
        try {
            return response()->json([
                'success' => true,
                'results' => $this->empleados->findByField('no_empleado', $no_empleado)->first()
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->getEmpleadoNo() | " . $e->getMessage() . " | " . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->getEmpleadoNo() | " . $e->getMessage() . " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }

    public function saveAsistencia(Request $request)
    {
        try {
            $empleado = $this->empleados->find($request->empleado_id);
            if (!$empleado) {
                return response()->json([
                    'success' => false,
                    'message' => "El empleado no existe.",
                ], 400);
            }

            $sucursal = $this->sucursales->find($request->sucursal_id);
            if (!$sucursal) {
                return response()->json([
                    'success' => false,
                    'message' => "La sucursal no existe.",
                ], 400);
            }

            $fotoPath = null;

            if (!empty($request->imagen) && is_array($request->imagen)) {
                $cadena = '';
                foreach ($request->imagen as $byte) {
                    $cadena .= chr($byte);
                }

                $fname = md5(uniqid('', true)) . '.jpg';
                $fotoPath = "asistencias/empleado_{$request->empleado_id}/{$fname}";
                Storage::disk('public')->put($fotoPath, $cadena);
            }

            $this->asistencia->create([
                'empleado_id' => $request->empleado_id,
                'sucursal_id' => $request->sucursal_id,
                'fecha' => now()->toDateString(),
                'hora' => now()->toTimeString(),
                'motivo' => $request->motivo,
                'imagen' => $fotoPath
            ]);

            return response()->json([
                'success' => true,
                'message' => "Asistencia registrada correctamente.",
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->saveAsistencia() | " . $e->getMessage() . " | " . $e->getLine());
            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->saveAsistencia() | " . $e->getMessage() . " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }



    public function historialAsistencias($empleado_id)
    {
        try {
            $asistencias = $this->asistencia
                ->where('empleado_id', $empleado_id)
                ->orderBy('fecha')
                ->orderBy('hora')
                ->get()
                ->groupBy('fecha');

            if ($asistencias->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontraron registros de asistencias para este empleado.',
                ], 300);
            }

            $resultado = [];

            foreach ($asistencias as $fecha => $registros) {
                $asistencia = [];
                $entrada = null;
                $foto_entrada = null;

                foreach ($registros as $registro) {
                    $fechaHora = $registro->fecha . ' ' . $registro->hora;
                    $foto = $registro->imagen ? $registro->imagen : null;

                    if ($registro->motivo == 0) { // Entrada
                        $entrada = $fechaHora;
                        $foto_entrada = $foto;
                    } else { // Salida
                        if ($entrada) {
                            $asistencia[] = [
                                'entrada' => $entrada,
                                'foto_entrada' => $foto_entrada,
                                'salida' => $fechaHora,
                                'foto_salida' => $foto
                            ];
                            $entrada = null;
                            $foto_entrada = null;
                        } else {
                            $asistencia[] = [
                                'salida' => $fechaHora,
                                'foto_salida' => $foto
                            ];
                        }
                    }
                }

                if ($entrada) {
                    $asistencia[] = [
                        'entrada' => $entrada,
                        'foto_entrada' => $foto_entrada
                    ];
                }

                $resultado[] = [
                    'fecha' => $fecha,
                    'asistencia' => $asistencia
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $resultado,
            ], 200);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->historialAsistencias() | " . $e->getMessage() . " | " . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->historialAsistencias() | " . $e->getMessage() . " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }

    public function reportesAsistencias(Request $request)
    {
        try {
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
            $sucursal_id = $request->sucursal_id;

            $query = $this->asistencia
                ->whereBetween('fecha', [$fecha_inicio, $fecha_fin])
                ->where('motivo', 0);

            if (!empty($sucursal_id)) {
                $query->where('sucursal_id', $sucursal_id);
            }

            $lista = $query->orderBy('fecha')->orderBy('hora')->get();

            $lista_x_empleado = $lista->groupBy(function ($item) {
                return $item->empleado_id . '_' . $item->fecha;
            });

            $empleados_ids = $lista->pluck('empleado_id')->unique();
            $empleados = $this->empleados->with('infoPuesto')->whereIn('id', $empleados_ids)->get()->keyBy('id');

            $periodo =  CarbonPeriod::create($fecha_inicio, $fecha_fin);
            $results = [];

            $asistencias_por_empleado = $lista->groupBy('empleado_id');

            foreach ($empleados as $empleado_id => $empleado) {
                $horario_config = $empleado->infoPuesto?->horario ?? [];

                $asistenciasEmpleado = $asistencias_por_empleado[$empleado_id] ?? collect();
                $asistencias_por_dia = $asistenciasEmpleado->groupBy('fecha');

                $asistencias = 0;
                $retardos = 0;
                $faltas = 0;

                foreach ($periodo as $fechaObj) {
                    $fecha = $fechaObj->format('Y-m-d');
                    $diaNombre = ucfirst($fechaObj->locale('es')->isoFormat('dddd'));

                    $config_dia = collect($horario_config)->firstWhere('dia', $diaNombre);
                    if (!$config_dia || empty($config_dia['inicio'])) {
                        continue;
                    }

                    $registroDia = $asistencias_por_dia[$fecha] ?? null;

                    if ($registroDia) {
                        $asistencias++;
                        $primerRegistro = $registroDia->first();
                        $horaEntradaEmpleado = Carbon::createFromFormat('H:i:s', $primerRegistro->hora);
                        $horaConfigurada = Carbon::createFromFormat('H:i', $config_dia['inicio']);

                        $diferenciaMinutos = $horaConfigurada->diffInMinutes($horaEntradaEmpleado, false);


                        if ($diferenciaMinutos >= 10) {
                            $retardoUnidades = ceil($diferenciaMinutos / 70);
                            $retardos += $retardoUnidades;
                        }
                    } else {
                        $faltas++;
                    }
                }

                $results[] = [
                    'no_empleado' => $empleado->no_empleado,
                    'nombre' => $empleado->nombre_completo,
                    'asistencias' => $asistencias,
                    'retardos' => $retardos,
                    'faltas' => $faltas,
                ];
            }

            return response()->json([
                'success' => true,
                'results' => $results,
            ]);
        } catch (\Exception $e) {
            Log::info("EmpleadosController->reportesAsistencias() | " . $e->getMessage() . " | " . $e->getLine());

            return response()->json([
                'success' => false,
                'message' => "[ERROR] EmpleadosController->reportesAsistencias() | " . $e->getMessage() . " | " . $e->getLine(),
                'results' => null
            ], 500);
        }
    }
}
