<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'prefix' => 'auth'
], function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::get('powerrepo',[ReportController::class, 'powerrepo']);
    Route::get('powerrepor', [ReportController::class, 'powerrepor']);
    Route::get('permisosAceptados',[AdminController::class, 'permisosAceptados']);
    Route::post('adminguardar',[AdminController::class,'adminguardar']);
    Route::get('permisosreg',[AdminController::class, 'permisosreg']);
    Route::get('reporte1',[ReportController::class, 'reporte1']);
    Route::get('reporte2',[ReportController::class, 'reporte2']);
    Route::get('reporte3',[ReportController::class, 'reporte3']);
    Route::get('reporte4',[ReportController::class, 'reporte4']);
    Route::get('reporte5',[ReportController::class, 'reporte5']);
    Route::get('reporte6',[ReportController::class, 'reporte6']);
    Route::get('reporte7',[ReportController::class, 'reporte7']);   
     Route::get('reporte8',[ReportController::class, 'reporte8']);

    Route::group([
        'middleware' => 'auth:api'
    ], function(){
        Route::get('logout',[AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});