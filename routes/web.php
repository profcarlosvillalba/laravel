<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');

    Route::get('/tareas', [App\Http\Controllers\TareaController::class, 'index'])
        ->name('tareas.index')  
        ->middleware('permission:ver tareas');

    Route::get('/tareas/create', [App\Http\Controllers\TareaController::class, 'create'])
        ->name('tareas.create')
        ->middleware('permission:crear tareas');

    Route::post('/tareas', [App\Http\Controllers\TareaController::class, 'store'])
        ->name('tareas.store')
        ->middleware('permission:crear tareas');
    
    Route::get('tareas/{tarea}/edit', [App\Http\Controllers\TareaController::class, 'edit'])
        ->name('tareas.edit')
        ->middleware('permission:editar tareas');

    Route::put('/tareas/{tarea}', [App\Http\Controllers\TareaController::class, 'update'])
        ->name('tareas.update')
        ->middleware('permission:editar tareas');

    Route::delete('tareas/{tarea}', [App\Http\Controllers\TareaController::class, 'destroy'])
        ->name('tareas.destroy')
        ->middleware('permission:eliminar tareas');

    Route::get('/vehiculos', [App\Http\Controllers\CarController::class, 'index'])->name('vehiculos.index');
    Route::get('/vehiculos/create', [App\Http\Controllers\CarController::class, 'create'])->name('vehiculos.create');
    Route::post('/vehiculos', [App\Http\Controllers\CarController::class, 'store'])->name('vehiculos.store');
    Route::get('vehiculos/{vehiculo}/edit', [App\Http\Controllers\CarController::class, 'edit'])->name('vehiculos.edit');
    Route::put('/vehiculos/{vehiculo}', [App\Http\Controllers\CarController::class, 'update'])->name('vehiculos.update');
    Route::delete('vehiculos/{vehiculo}', [App\Http\Controllers\CarController::class, 'destroy'])->name('vehiculos.destroy');
    Route::get('/vehiculos/export/pdf', [App\Http\Controllers\CarController::class, 'exportPDF'])
     ->name('vehiculos.exportPdf');



    // Listado de usuarios
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])
        ->name('users.index')
        ->middleware('permission:ver usuarios');

    // Formulario crear usuario
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])
        ->name('users.create')
        ->middleware('permission:crear usuarios');

    // Guardar usuario
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])
        ->name('users.store')
        ->middleware('permission:crear usuarios');

    // Mostrar usuario (opcional)
    Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])
        ->name('users.show')
        ->middleware('permission:ver usuarios');

    // Formulario editar usuario
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware('permission:editar usuarios');

    // Actualizar usuario
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])
        ->name('users.update')
        ->middleware('permission:editar usuarios');

    // Eliminar usuario
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('permission:borrar usuarios');

});


Route::get('/test', function () {
    return 'Ruta de prueba activa';
});
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
