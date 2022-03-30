<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\ParameterController;
use \App\Http\Controllers\CompanyController;
use \App\Http\Controllers\Auth\LoginController;

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

Route::get('login/', function () {
    return view('layouts.app');
});
Route::get('admin/login', function () {
    return view('layouts.app');
});
Route::post('login/', [LoginController::class, 'login']);
Route::post('admin/login', [LoginController::class, 'loginAdmin']);


Route::prefix('api')->group(function () {
    Route::post('parameters/', [ParameterController::class, 'store']);
    Route::post('companies/', [CompanyController::class, 'store']);
    Route::put('parameters/{parameter}/companies/{company}', [ParameterController::class, 'updateChecked']);

    Route::prefix('admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('{user}/', [UserController::class, 'show']);
        });
    });
});

Route::get('admin/{any?}/', function () {
    return view('layouts.app');
})->where('any', '.*')->middleware(['auth:sanctum', 'can:administrate']);

Route::get('{any?}/', function () {
    return view('layouts.app');
})->where('any', '.*')->middleware('auth:sanctum');
