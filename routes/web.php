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


Auth::routes();


Route::get('/', function () {
    if (Auth::check()){
        return redirect('/dashboard');
    }else{
        return view('auth.login');     
    }
})->name('login');


Route::get('/error', function () {
    if (Auth::check()){
        return view('error');
    }else{
        return redirect('/');            
    }
});


Route::post('logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);
Route::get('login', [App\Http\Controllers\Auth\LoginController::class,'redirectLogin']);
Route::post('login', [App\Http\Controllers\Auth\LoginController::class,'login']);


Route::get('/login', function () {
    if (Auth::check()){
        return redirect('/dashboard');
    }else{
        return redirect('/');            
    }
});

Route::get('/home', function () {
    if (Auth::check()){
        return redirect('/dashboard');
    }else{
        return redirect('/login');            
    }
});



Route::get('dashboard',[App\Http\Controllers\DashboardController::class,'index']);

Route::get('administrador',[App\Http\Controllers\AdministradorController::class,'index']);
Route::get('administrador/create',[App\Http\Controllers\AdministradorController::class,'create']);
Route::post('administrador/create',[App\Http\Controllers\AdministradorController::class,'store']);
Route::get('administrador/search',[App\Http\Controllers\AdministradorController::class,'search']);
Route::get('administrador/{id}',[App\Http\Controllers\AdministradorController::class,'show']);
Route::get('administrador/{id}/edit',[App\Http\Controllers\AdministradorController::class,'edit']);
Route::post('administrador/update',[App\Http\Controllers\AdministradorController::class,'update']);
Route::post('administrador/estado',[App\Http\Controllers\AdministradorController::class,'updateEstado']);
Route::post('administrador/delete',[App\Http\Controllers\AdministradorController::class,'destroy']);


Route::get('ciudad',[App\Http\Controllers\CiudadController::class,'index']);
Route::get('ciudad/create',[App\Http\Controllers\CiudadController::class,'create']);
Route::post('ciudad/create',[App\Http\Controllers\CiudadController::class,'store']);
Route::get('ciudad/{idciudad}/edit',[App\Http\Controllers\CiudadController::class,'edit']);
Route::post('ciudad/update',[App\Http\Controllers\CiudadController::class,'update']);
Route::post('ciudad/delete',[App\Http\Controllers\CiudadController::class,'destroy']);
Route::get('ciudad/{id}',[App\Http\Controllers\CiudadController::class,'show']);

Route::get('colaborador',[App\Http\Controllers\ColaboradorController::class,'index']);
Route::get('colaborador/create',[App\Http\Controllers\ColaboradorController::class,'create']);
Route::post('colaborador/create',[App\Http\Controllers\ColaboradorController::class,'store']);
Route::get('colaborador/search',[App\Http\Controllers\ColaboradorController::class,'search']);
Route::get('colaborador/{id}',[App\Http\Controllers\ColaboradorController::class,'show']);
Route::get('colaborador/{id}/edit',[App\Http\Controllers\ColaboradorController::class,'edit']);
Route::post('colaborador/update',[App\Http\Controllers\ColaboradorController::class,'update']);
Route::post('colaborador/estado',[App\Http\Controllers\ColaboradorController::class,'updateEstado']);
Route::post('colaborador/delete',[App\Http\Controllers\ColaboradorController::class,'destroy']);


Route::get('cliente',[App\Http\Controllers\ClienteController::class,'index']);
Route::get('cliente/create',[App\Http\Controllers\ClienteController::class,'create']);
Route::post('cliente/create',[App\Http\Controllers\ClienteController::class,'store']);
Route::get('cliente/search',[App\Http\Controllers\ClienteController::class,'search']);
Route::get('cliente/{id}',[App\Http\Controllers\ClienteController::class,'show']);
Route::get('cliente/{id}/edit',[App\Http\Controllers\ClienteController::class,'edit']);
Route::post('cliente/update',[App\Http\Controllers\ClienteController::class,'update']);
Route::post('cliente/estado',[App\Http\Controllers\ClienteController::class,'updateEstado']);
Route::post('cliente/delete',[App\Http\Controllers\ClienteController::class,'destroy']);



Route::get('emergencia',[App\Http\Controllers\EmergenciaController::class,'index']);
Route::get('emergencia/create',[App\Http\Controllers\EmergenciaController::class,'create']);
Route::post('emergencia/create',[App\Http\Controllers\EmergenciaController::class,'store']);
Route::get('emergencia/search',[App\Http\Controllers\EmergenciaController::class,'search']);
Route::get('emergencia/{id}',[App\Http\Controllers\EmergenciaController::class,'show']);
Route::get('emergencia/{id}/edit',[App\Http\Controllers\EmergenciaController::class,'edit']);
Route::post('emergencia/update',[App\Http\Controllers\EmergenciaController::class,'update']);
Route::post('emergencia/estado',[App\Http\Controllers\EmergenciaController::class,'updateEstado']);
Route::post('emergencia/delete',[App\Http\Controllers\EmergenciaController::class,'destroy']);



Route::get('cortes',[App\Http\Controllers\CortesController::class,'index']);
Route::get('cortes/create',[App\Http\Controllers\CortesController::class,'create']);
Route::post('cortes/create',[App\Http\Controllers\CortesController::class,'store']);
Route::get('cortes/search',[App\Http\Controllers\CortesController::class,'search']);
Route::get('cortes/{id}',[App\Http\Controllers\CortesController::class,'show']);
Route::get('cortes/{id}/edit',[App\Http\Controllers\CortesController::class,'edit']);
Route::post('cortes/update',[App\Http\Controllers\CortesController::class,'update']);
Route::post('cortes/estado',[App\Http\Controllers\CortesController::class,'updateEstado']);
Route::post('cortes/delete',[App\Http\Controllers\CortesController::class,'destroy']);



Route::get('gestion',[App\Http\Controllers\GestionController::class,'index']);
Route::get('gestion/create',[App\Http\Controllers\GestionController::class,'create']);
Route::post('gestion/create',[App\Http\Controllers\GestionController::class,'store']);
Route::get('gestion/search',[App\Http\Controllers\GestionController::class,'search']);
Route::get('gestion/{id}',[App\Http\Controllers\GestionController::class,'show']);
Route::get('gestion/{id}/edit',[App\Http\Controllers\GestionController::class,'edit']);
Route::post('gestion/update',[App\Http\Controllers\GestionController::class,'update']);
Route::post('gestion/delete',[App\Http\Controllers\GestionController::class,'destroy']);


Route::get('mensualidad',[App\Http\Controllers\MensualidadController::class,'index']);
Route::get('mensualidad/create',[App\Http\Controllers\MensualidadController::class,'create']);
Route::post('mensualidad/create',[App\Http\Controllers\MensualidadController::class,'store']);
Route::get('mensualidad/search',[App\Http\Controllers\MensualidadController::class,'search']);
Route::get('mensualidad/{id}',[App\Http\Controllers\MensualidadController::class,'show']);
Route::get('mensualidad/{id}/edit',[App\Http\Controllers\MensualidadController::class,'edit']);
Route::post('mensualidad/update',[App\Http\Controllers\MensualidadController::class,'update']);
Route::post('mensualidad/delete',[App\Http\Controllers\MensualidadController::class,'destroy']);


Route::get('medicion',[App\Http\Controllers\MedicionController::class,'index']);
Route::get('medicion/create',[App\Http\Controllers\MedicionController::class,'create']);
Route::post('medicion/create',[App\Http\Controllers\MedicionController::class,'store']);
Route::get('medicion/search',[App\Http\Controllers\MedicionController::class,'search']);
Route::get('medicion/{id}',[App\Http\Controllers\MedicionController::class,'show']);
Route::get('medicion/{id}/edit',[App\Http\Controllers\MedicionController::class,'edit']);
Route::post('medicion/update',[App\Http\Controllers\MedicionController::class,'update']);
Route::get('medicionExcel/{idCiudad}/{idMensualidad}/{idColaborador}/{estado}',[App\Http\Controllers\MedicionController::class,'medicionExcel']);


Route::get('factura',[App\Http\Controllers\FacturaController::class,'index']);
Route::get('factura/search',[App\Http\Controllers\FacturaController::class,'search']);
Route::get('factura/{id}',[App\Http\Controllers\FacturaController::class,'show']);
Route::get('facturaExcel/{idCiudad}/{idMensualidad}/{idColaborador}/{pagado}',[App\Http\Controllers\FacturaController::class,'facturaExcel']);


Route::get('reporte/reporteGeneral',[App\Http\Controllers\ReporteController::class,'reporteGeneral']);
Route::get('reporte/generarReporteGeneral/{idCiudad}/{idMensualidad}/{idColaborador}/{idCliente}/{estado}/{pagado}',[App\Http\Controllers\ReporteController::class,'generarReporteGeneral']);
Route::get('reporte/reporteMedicion/{idMedicion}',[App\Http\Controllers\ReporteController::class,'reporteMedicion']);
Route::get('reporte/reporteFactura/{idFactura}',[App\Http\Controllers\ReporteController::class,'reporteFactura']);



