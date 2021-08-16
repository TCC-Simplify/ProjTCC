<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EquipesController;
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

    Route::get('/equipes', [EquipesController::class, 'index'])->name('equipes.index');
    Route::get('/equipes/{equipe}', [EquipesController::class, 'show'])->name('equipes.show');

    Route::get('/messages/{user}', [MessageController::class, 'listMessages'])->name('message.listMessages');
    Route::post('/messages/store', [MessageController::class, 'store'])->name('message.store');
});
