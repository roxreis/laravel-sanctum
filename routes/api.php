<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Api\LoginController;

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

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/user', function (Request $request) {
//         return $request->user();
//     });
// });

// Route::post('/login', [LoginController::class, 'login']);
// Route::get('/logout', [LoginController::class, 'logout']);

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'getUsers');
    Route::get('/user/{id}', 'getUser');
    // Route::get('/users', 'getUsers');
    // Route::get('/users', 'getUsers');
    Route::post('/user/create', 'postUser');
    Route::put('/address/update/{id}', [AddressController::class, 'putAddress']);
    Route::delete('/address/delete/{id}', [AddressController::class, 'deleteAddress']);

    Route::post('/orders', 'store');
});
