<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\ParameterController;
use \App\Http\Controllers\CompanyController;
use \App\Http\Controllers\Auth\LoginController;
use \Illuminate\Support\Facades\Auth;

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
})->name('login');

Route::prefix('api')->group(function () {
    Route::post('login/', [LoginController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout/', [LoginController::class, 'logout']);

        Route::post('parameters/', [ParameterController::class, 'store']);
        Route::post('companies/', [CompanyController::class, 'store']);
        Route::post('parameters/{parameter}/companies/{company}', [ParameterController::class, 'storeCompanyRelation']);
        Route::delete('parameters/{parameter}/companies/{company}', [ParameterController::class, 'deleteCompanyRelation']);

        Route::prefix('users')->group(function () {
            Route::get('me/', function () {
                return redirect('/api/users/' . Auth::id());
            });
            Route::get('{user}/', [UserController::class, 'show'])->middleware('can:show,user');
        });

        Route::get('admin/users/', [UserController::class, 'index'])->middleware('can:administrate');
    });
});

Route::get('admin/{any?}/', function () {
    return view('layouts.app');
})->where('any', '.*')->middleware(['auth:sanctum', 'can:administrate']);

Route::get('{any?}/', function () {
    return view('layouts.app');
})->where('any', '.*')->middleware('auth:sanctum');
