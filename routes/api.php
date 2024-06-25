<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('cliente/login',[App\Http\Controllers\Api\ClienteController::class,'login']);
Route::post('cliente/registroDispositivo',[App\Http\Controllers\Api\ClienteController::class,'registroDispositivo']);
Route::post('cliente/enviarCodigoRecuperacionPassword',[App\Http\Controllers\Api\ClienteController::class,'enviarCodigoRecuperacionPassword']);
Route::post('cliente/validarCodigoRecuperacionPassword',[App\Http\Controllers\Api\ClienteController::class,'validarCodigoRecuperacionPassword']);
Route::post('cliente/nuevoPassword',[App\Http\Controllers\Api\ClienteController::class,'nuevoPassword']);
Route::post('cliente/editarPerfil',[App\Http\Controllers\Api\ClienteController::class,'editarPerfil']);

Route::post('colaborador/login',[App\Http\Controllers\Api\ColaboradorController::class,'login']);
Route::post('colaborador/registroDispositivo',[App\Http\Controllers\Api\ColaboradorController::class,'registroDispositivo']);
Route::post('colaborador/editarPerfil',[App\Http\Controllers\Api\ColaboradorController::class,'editarPerfil']);

Route::post('medicion/listar',[App\Http\Controllers\Api\MedicionController::class,'listar']);

Route::post('ciudad/precioMensualidad',[App\Http\Controllers\Api\CiudadController::class,'precioMensualidad']);

Route::post('factura/listar',[App\Http\Controllers\Api\FacturaController::class,'listar']);
Route::post('factura/generarFactura',[App\Http\Controllers\Api\FacturaController::class,'generarFactura']);


Route::get('reporte/reporteMedicion/{idMedicion}',[App\Http\Controllers\Api\ReporteController::class,'reporteMedicion']);
Route::get('reporte/reporteFactura/{idFactura}',[App\Http\Controllers\Api\ReporteController::class,'reporteFactura']);


Route::post('notificacion/enviarNotificacion',[App\Http\Controllers\Api\NotificacionController::class,'enviarNotificacion']);

Route::get('pago/{token}',[App\Http\Controllers\Api\PagoController::class,'index']);
Route::post('pago/confirmar',[App\Http\Controllers\Api\PagoController::class,'confirmar']);
Route::post('pago/callback/{token}',[App\Http\Controllers\Api\PagoController::class,'callback']);



Route::post('googleCloudVision/analizarImagen',[App\Http\Controllers\Api\GoogleCloudVisionController::class,'analizarImagen']);





