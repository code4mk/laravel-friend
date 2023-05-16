<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1', 'middleware' => []], function () {

    // Demo route. (sample).
    Route::get('/demos', [DemoController::class, 'getDemos']);
    Route::get('/demos/{demoId}', [DemoController::class, 'getDemoById']);
    Route::post('/demos', [DemoController::class, 'createDemo']);
    Route::put('/demos/{demoId}', [DemoController::class, 'updateDemo']);
    Route::delete('/demos/{demoId}', [DemoController::class, 'deleteDemo']);
});
