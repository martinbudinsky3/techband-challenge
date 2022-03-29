<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ParameterController;
use \App\Http\Controllers\CompanyController;

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

Route::prefix('api')->group(function () {
    Route::post('parameters/', [ParameterController::class, 'store']);
    Route::post('companies/', [CompanyController::class, 'store']);
    Route::put('parameters/{parameter}/companies/{company}', [ParameterController::class, 'index']);

    Route::prefix('admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('{user}/', [UserController::class, 'show']);
        });
    });
});

Route::get('admin/{any?}/', function () {
    return view('layouts.app');
})->where('any', '.*')/*->middleware('auth')*/;

Route::get('{any?}/', function () {
    return view('layouts.app');
})->where('any', '.*')/*->middleware('auth')*/;
