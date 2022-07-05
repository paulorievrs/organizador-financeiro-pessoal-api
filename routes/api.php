<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;

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


Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [ AuthController::class, 'login' ]);
    Route::post('/register', [ AuthController::class, 'register' ]);
});

Route::group(['middleware' => 'jwt'], function () {

   Route::group(['prefix' => 'auth'], function () {
       Route::post('/logout', [ AuthController::class, 'logout' ]);
       Route::get('/me', [ AuthController::class, 'me' ]);
   });

   Route::group(['prefix' => 'expenses'], function () {
       Route::get('/', [ ExpenseController::class, 'list' ] );
       Route::post('/', [ ExpenseController::class, 'create' ] );
       Route::get('/types', [ ExpenseController::class, 'fetchExpensesType' ] );
       Route::put('/{expenseId}', [ ExpenseController::class, 'update' ] );
       Route::delete('/{expenseId}', [ ExpenseController::class, 'delete' ] );
   });

});
