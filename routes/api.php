<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\BookController;

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
    Route::put('/user/update/{id}', 'putUser');
    Route::delete('/user/delete/{id}', 'deleteUser');;
});

Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'getBooks');
    Route::get('/book/{id}', 'getBook');
    // Route::get('/books', 'getBooks');
    // Route::get('/books', 'getBooks');
    Route::post('/book/create', 'postBook');
    Route::put('/book/update/{id}', 'putBook');
    Route::delete('/book/delete/{id}', 'deleteBook');
});
