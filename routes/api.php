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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => 'auth:sanctum'], function () {
//     Route::get('creator', [ApiController::class, 'index']);
//     Route::post('table', [TableController::class, 'store'])->name('table');
//     Route::post('menu', [MenuController::class, 'store'])->name('menu');
//     Route::post('menu_type', [MenuController::class, 'storeType'])->name('menu_type');
//     Route::post('order', [OrderController::class, 'store'])->name('order');
// });