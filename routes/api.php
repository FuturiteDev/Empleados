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
    Route::post('/delete', [EmpleadosController::class, 'delete'])->name('delete_empleados');
});