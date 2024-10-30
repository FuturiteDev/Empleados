<?php
use Illuminate\Support\Facades\Route;
use Ongoing\Empleados\Http\Controllers\EmpleadosController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/', [EmpleadosController::class, 'index'])->name('empleados.list');
});