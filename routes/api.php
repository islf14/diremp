<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FrontController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\CategoriaController;
use App\Http\Controllers\Api\Admin\EmpresaController;
use App\Http\Controllers\Api\Client\EmpresaController as EmpresaClient;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function(){
    //////PUBLIC
    //::PUBLIC
    Route::get('/public/{slug}',[FrontController::Class,'catogoria']);
    //::auth
    Route::post('/auth/register',[AuthController::Class,'register']);
    Route::post('/auth/login',[AuthController::Class,'login']);

    //////PRIVATE
    Route::group(['middleware'=>'auth:sanctum'], function(){
        //::auth
        Route::post('/auth/logout',[AuthController::Class, 'logout']);

        //::rol client
        Route::apiResource('/client/empresa', EmpresaClient::Class);

        //::rol admin
        Route::apiResource('/admin/user', UserController::Class);
        Route::apiResource('/admin/category', CategoriaController::Class);
        Route::apiResource('/admin/company', EmpresaController::Class);
    });

});