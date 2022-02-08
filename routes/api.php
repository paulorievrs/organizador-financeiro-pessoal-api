<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::post('/auth/login', [ AuthController::class, 'login' ]);

Route::group(['middleware' => 'jwt'], function () {

   Route::group(['prefix' => 'auth'], function () {

      Route::post('/logout', [ AuthController::class, 'logout' ]);

   });

});
