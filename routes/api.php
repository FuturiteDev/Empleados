<?php

use Illuminate\Support\Facades\Route;
use Ongoing\Empleados\Http\Controllers\EmpleadosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('empleados')->group(function () {
    Route::get('/all', [EmpleadosController::class, 'getAll'])->name('get_all_empleados');
    Route::post('/save-empleado', [EmpleadosController::class, 'saveEmpleado'])->name('save-empleados');
    Route::post('/save-puesto-empleado', [EmpleadosController::class, 'savePuestoEmpleado'])->name('save-puesto-empleado');
    Route::post('/save-nomina-empleado', [EmpleadosController::class, 'saveNominaEmpleado'])->name('save-nomina-empleado');
    Route::post('/save-file-empleado', [EmpleadosController::class, 'saveFileEmpleado'])->name('save-file-empleado');
    Route::post('/delete-file-empleado', [EmpleadosController::class, 'deleteFileEmpleado'])->name('delete-file-empleado');
    Route::post('/delete', [EmpleadosController::class, 'delete'])->name('delete_empleados');
    Route::get('/areas', [EmpleadosController::class, 'getAreas'])->name('get_areas_empleados');
    Route::get('/puestos', [EmpleadosController::class, 'getPuestos'])->name('get_puestos_empleados');
    Route::get('/get-empleado-numero/{no_empleado}', [EmpleadosController::class, 'getEmpleadoNo'])->name('getEmpleadoNo');
    Route::post('/registrar-asistencia', [EmpleadosController::class, 'saveAsistencia'])->name('saveAsistencia');
    Route::get('/obtener-asistencias/{empelado_id}', [EmpleadosController::class, 'historialAsistencias'])->name('historialAsistencias');
});