<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EquipeController;
use App\Http\Controllers\Api\MessageController;

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

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::get('/messages/{user}', [MessageController::class, 'listMessages'])->name('message.listMessages');
    Route::post('/messages/store', [MessageController::class, 'store'])->name('message.store');
});

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/equipes', [EquipeController::class, 'index'])->name('equipes.index');
    Route::get('/equipes/{equipe}', [EquipeController::class, 'show'])->name('equipes.show');
});
