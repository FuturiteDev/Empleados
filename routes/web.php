<?php
use Illuminate\Support\Facades\Route;
use Ongoing\Empleados\Http\Controllers\EmpleadosController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/', [EmpleadosController::class, 'index'])->name('empleados.list');
    Route::get('/detalle/{id}', [EmpleadosController::class, 'detalle'])->name('empleados.detalle');
    Route::get('/asistencias', [EmpleadosController::class, 'asistencias'])->name('asistencias');

});