<?php

use App\Http\Controllers\TestController;
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

// Route::middleware('auth:apikey')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth.apikey'])->group(function () {

    Route::post('/test',[TestController::class,'index']);
    Route::post('cond',[TestController::class,'cond']);

    Route::post('del',[TestController::class,'del']);

    Route::post('update',[TestController::class,'update']);

});

