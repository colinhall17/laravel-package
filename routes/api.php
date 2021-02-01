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

Route::prefix(config('skeleton.routes.api_prefix'))->middleware(config('skeleton.routes.api_middleware'))->group(function(){
    Route::get('/test', function(){
        return json([
            'message' => 'all good'
        ]);
    });

    Route::get('/skeleton', [\MacsiDigital\Skeleton\Http\Controllers\Api\SkeletonController::class, 'index']);
});
