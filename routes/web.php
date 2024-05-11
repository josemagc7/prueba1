<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

// Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    //Tratamiento
    Route::get('/tratamientos', [App\Http\Controllers\Admin\TratamientoController::class, 'index']);
    Route::get('/tratamientos/create', [App\Http\Controllers\Admin\TratamientoController::class, 'create']);
    Route::get('/tratamientos/{tratamiento}/edit', [App\Http\Controllers\Admin\TratamientoController::class, 'edit']);
    Route::post('/tratamientos', [App\Http\Controllers\Admin\TratamientoController::class, 'add']);
    Route::put('/tratamientos/{tratamiento}', [App\Http\Controllers\Admin\TratamientoController::class, 'update']);
    Route::delete('/tratamientos/{tratamiento}', [App\Http\Controllers\Admin\TratamientoController::class, 'delete']);


    //Peluqueros
    Route::get('/peluqueros', [App\Http\Controllers\Admin\peluqueroController::class, 'index']);
    Route::get('/peluqueros/create', [App\Http\Controllers\Admin\peluqueroController::class, 'create']);
    Route::get('/peluqueros/{peluquero}/edit', [App\Http\Controllers\Admin\peluqueroController::class, 'edit']);
    Route::post('/peluqueros', [App\Http\Controllers\Admin\peluqueroController::class, 'add']);
    Route::put('/peluqueros/{peluquero}', [App\Http\Controllers\Admin\peluqueroController::class, 'update']);
    Route::delete('/peluqueros/{peluquero}', [App\Http\Controllers\Admin\peluqueroController::class, 'delete']);


    //clientes
    Route::get('/clientes', [App\Http\Controllers\Admin\clienteController::class, 'index']);
    Route::get('/clientes/create', [App\Http\Controllers\Admin\clienteController::class, 'create']);
    Route::get('/clientes/{cliente}/edit', [App\Http\Controllers\Admin\clienteController::class, 'edit']);
    Route::post('/clientes', [App\Http\Controllers\Admin\clienteController::class, 'add']);
    Route::put('/clientes/{cliente}', [App\Http\Controllers\Admin\clienteController::class, 'update']);
    Route::put('/clientes/{cliente}', [App\Http\Controllers\Admin\clienteController::class, 'delete']);
});

Route::middleware(['auth', 'peluquero'])->group(function () {
      //Horario
    //   Route::get('/horario', [App\Http\Controllers\Peluquero\HorarioController::class, 'index']);

    //   Route::get('/horario/create', [App\Http\Controllers\Peluquero\HorarioController::class, 'create']);

      Route::get('/horario', [App\Http\Controllers\Peluquero\HorarioController::class, 'edit']);

      Route::post('/horario', [App\Http\Controllers\Peluquero\HorarioController::class, 'add']);
      Route::get('/citasPeluquero', [App\Http\Controllers\CitaController::class, 'citasPeluqueroHOY']);
      Route::get('/citaCompletada', [App\Http\Controllers\CitaController::class, 'updateCita']);



    //   Route::put('/horario/{tratamiento}', [App\Http\Controllers\Peluquero\HorarioController::class, 'update']);

    //   Route::delete('/horario/{tratamiento}', [App\Http\Controllers\Peluquero\HorarioController::class, 'delete']);
});

// Route::get('/citas/create', [App\Http\Controllers\Cliente\CitasController::class, 'create']);
// Route::post('/citas', [App\Http\Controllers\Cliente\CitasController::class, 'add']);
Route::middleware('auth')->group(function () {

    Route::get('/citas/create', [App\Http\Controllers\CitaController::class, 'create']);
    Route::post('/citas', [App\Http\Controllers\CitaController::class, 'add']);
    Route::get('/vercitas', [App\Http\Controllers\CitaController::class, 'vercitas']);
    Route::delete('/citas/{id}', [App\Http\Controllers\CitaController::class, 'delete']);

    //json
    Route::get('/tratamientos/{tratamiento}/peluqueros',[App\Http\Controllers\Api\TratamientoController::class, 'peluqueros']);
    Route::get('/horarios/horas',[App\Http\Controllers\Api\HorariosController::class, 'horas']);
    // Route::get('/horarios/horasDeshabilitadas',[App\Http\Controllers\Api\HorariosController::class, 'horasDeshabilitadas']);

    Route::get('/miPerfil', [App\Http\Controllers\MiPerfilController::class, 'index']);
    Route::get('/miPerfil/ajustes', [App\Http\Controllers\MiPerfilController::class, 'ajustes']);
    Route::get('/miPerfil/create', [App\Http\Controllers\MiPerfilController::class, 'create']);
    Route::get('/miPerfil/{cliente}/edit', [App\Http\Controllers\MiPerfilController::class, 'edit']);
    Route::post('/miPerfil', [App\Http\Controllers\MiPerfilController::class, 'add']);
    Route::put('/miPerfil/{cliente}', [App\Http\Controllers\MiPerfilController::class, 'update']);
    Route::delete('/miPerfil/{cliente}', [App\Http\Controllers\MiPerfilController::class, 'delete']);

});

