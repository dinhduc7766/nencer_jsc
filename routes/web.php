<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/demo-laravel', [DemoController::class, 'index']);

// Gop router thanh 1 nhom.
Route::group(['prefix' => 'category', 'middleware' => 'checkLogin'], function () {
    Route::get('/detail/{id}', [DemoController::class, 'detail']);
    Route::post('/update/{id}', [DemoController::class, 'update']);
    Route::get('/destroy/{id}', [DemoController::class, 'destroy']);
});

Route::get('/query-builder', [DemoController::class, 'queryBuilder']);
Route::get('eloquent', [DemoController::class, 'eloquent']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postLogin']);