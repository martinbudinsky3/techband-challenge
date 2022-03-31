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
})->name('login');

Route::get('admin/login', function () {
    return view('layouts.app');
})->name('login_admin');

Route::post('login/', [LoginController::class, 'login']);
Route::post('admin/login', [LoginController::class, 'loginAdmin']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'api', 'middleware' => 'auth:sanctum'], function () {
    Route::post('parameters/', [ParameterController::class, 'store']);
    Route::post('companies/', [CompanyController::class, 'store']);
    Route::post('parameters/{parameter}/companies/{company}', [ParameterController::class, 'storeCompanyRelation']);
    Route::delete('parameters/{parameter}/companies/{company}', [ParameterController::class, 'deleteCompanyRelation']);

    Route::prefix('admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->middleware('can:administrate');
            Route::get('{user}/', [UserController::class, 'show'])->middleware('can:show', \App\Models\User::class);
        });
    });
});

Route::get('admin/{any?}/', function () {
    return view('layouts.app');
})->where('any', '.*')->middleware('auth:sanctum')->name('admin');

Route::get('{any?}/', function () {
    return view('layouts.app');
})->where('any', '.*')->middleware('auth:sanctum');
