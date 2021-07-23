<?php

use App\Http\Controllers\AtividadesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\LogController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PontosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/

Route::get('/', function () {
    return view('welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/emails', function () {
    return view('emails');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    return Inertia::render('Chat');
})->name('chat');



Route::middleware(['auth:sanctum', 'verified'])->get('/log', [LogController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->post('/log/muda_senha', [LogController::class, 'muda']);

//rotas usuario
Route::middleware(['auth:sanctum', 'verified'])->get('/hom',function(){
    return view('home_register');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/cadastro_user',function(){
    return view('users/cad_users');
});
Route::middleware(['auth:sanctum', 'verified'])->post('/cad_user', [UsuarioController::class, 'create']);
Route::middleware(['auth:sanctum', 'verified'])->get('/users', [UsuarioController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/users_des', [UsuarioController::class, 'mostra']);

Route::middleware(['auth:sanctum', 'verified'])->get('/pag_user', [UsuarioController::class, 'show']);

Route::middleware(['auth:sanctum', 'verified'])->get('/alt_user/{id}', [UsuarioController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->get('/del_user/{id}', [UsuarioController::class, 'del']);
Route::middleware(['auth:sanctum', 'verified'])->get('/rea_user/{id}', [UsuarioController::class, 'reativa']);

Route::middleware(['auth:sanctum', 'verified'])->post('/update_user/{id}', [UsuarioController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/delete_user/{id}', [UsuarioController::class, 'delete']);

//Rotas Empresa
Route::middleware(['auth:sanctum', 'verified'])->get('/empresa', [EmpresaController::class, 'show']);
Route::get('/cadastro', [EmpresaController::class, 'create']);
Route::post('/cadastro_empresa', [EmpresaController::class, 'store']);

Route::middleware(['auth:sanctum', 'verified'])->get('/editar_empresa/{id}', [EmpresaController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->get('/del_empresa/{id}', [EmpresaController::class, 'mostra']);

Route::middleware(['auth:sanctum', 'verified'])->post('/update_empresa/{id}', [EmpresaController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/delete_empresa/{id}', [EmpresaController::class, 'delete']);

//Rotas Equipe
Route::middleware(['auth:sanctum', 'verified'])->get('/equipes', [EmpresaController::class, 'equipe_show_all']);
Route::middleware(['auth:sanctum', 'verified'])->get('/form_criar_equipe', [EmpresaController::class, 'equipe_create_form']);
Route::middleware(['auth:sanctum', 'verified'])->post('/criar_equipe', [EmpresaController::class, 'equipe_create']);
Route::middleware(['auth:sanctum', 'verified'])->post('/deletar_equipe', [EmpresaController::class, 'equipe_delete']);

Route::middleware(['auth:sanctum', 'verified'])->get('/equipe/{nome}', [EmpresaController::class, 'equipe_show']);
Route::middleware(['auth:sanctum', 'verified'])->get('/equipe/add/{nome}', [EmpresaController::class, 'equipe_add_form']);
Route::middleware(['auth:sanctum', 'verified'])->post('/equipe/add/processing/{nome}', [EmpresaController::class, 'equipe_add']);

Route::middleware(['auth:sanctum', 'verified'])->post('/equipe/delete', [EmpresaController::class, 'equipe_remove']);

//rotas zaneta
Route::middleware(['auth:sanctum', 'verified'])->get('/area_ponto', function () {
    return view('users/area_ponto');
});
Route::middleware(['auth:sanctum', 'verified'])->post('/ponto', [PontosController::class, 'create']);

//Mural
Route::middleware(['auth:sanctum', 'verified'])->get('/mural', function () {
    return view('controle/mural');
});

//Atividades
Route::middleware(['auth:sanctum', 'verified'])->get('/atividades{id?}', [AtividadesController::class, 'atividade_show']);
Route::middleware(['auth:sanctum', 'verified'])->get('/atividades/criar', [AtividadesController::class, 'atividade_criar']);

