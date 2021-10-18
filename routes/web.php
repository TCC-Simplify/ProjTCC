<?php

use App\Http\Controllers\AtividadesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\LogController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PontosController;

use App\Http\Controllers\JustificativaController;

use App\Http\Controllers\MuralController;

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

Route::get('/esqueceu-senha', function () {
    return view('auth.passwords.email');
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
Route::middleware(['auth:sanctum', 'verified'])->get('/hom', [LogController::class, 'hom']);

Route::middleware(['auth:sanctum', 'verified'])->get('/pag_user', [OverviewController::class, 'pag_user']);


Route::middleware(['auth:sanctum', 'verified'])->get('/cadastro_user',function(){
    return view('users/cad_users');
});
Route::middleware(['auth:sanctum', 'verified'])->post('/cad_user', [UsuarioController::class, 'create']);
Route::middleware(['auth:sanctum', 'verified'])->get('/users', [UsuarioController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/users_des', [UsuarioController::class, 'mostra']);

Route::middleware(['auth:sanctum', 'verified'])->get('/alt_user/{id}', [UsuarioController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->get('/del_user/{id}', [UsuarioController::class, 'del']);
Route::middleware(['auth:sanctum', 'verified'])->get('/rea_user/{id}', [UsuarioController::class, 'reativa']);

Route::middleware(['auth:sanctum', 'verified'])->post('/update_user/{id}', [UsuarioController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/delete_user/{id}', [UsuarioController::class, 'delete']);

//Rotas Empresa
Route::middleware(['auth:sanctum', 'verified'])->get('/empresa', [EmpresaController::class, 'show']);
Route::get('/cadastro', [EmpresaController::class, 'create']);
Route::post('/cadastro_empresa', [EmpresaController::class, 'store']); //cadastro empresa -> cadastro adm

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

//Ponto
Route::middleware(['auth:sanctum', 'verified'])->get('/area_ponto', function () {
    return view('users/area_ponto');
});
Route::middleware(['auth:sanctum', 'verified'])->post('/ponto', [PontosController::class, 'create']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dados_ponto', [PontosController::class, 'show']);
Route::middleware(['auth:sanctum', 'verified'])->post('/saida_ponto', [PontosController::class, 'saida']);
Route::middleware(['auth:sanctum', 'verified'])->get('/historico_ponto', [PontosController::class, 'historico']);
Route::middleware(['auth:sanctum', 'verified'])->post('/ponto_confirma', [PontosController::class, 'confirma']);

/*Mural
Route::middleware(['auth:sanctum', 'verified'])->get('/mural', function () {
    return view('controle/mural');
});*/

//Atividades
Route::middleware(['auth:sanctum', 'verified'])->get('/atividades{id?}', [AtividadesController::class, 'atividade_show']);
Route::middleware(['auth:sanctum', 'verified'])->get('/atividades/marcar_concluido/{id}', [AtividadesController::class, 'marcar_concluido']);
Route::middleware(['auth:sanctum', 'verified'])->get('/atividades/funcs{id?}', [AtividadesController::class, 'atividade_funcs_show']);
Route::middleware(['auth:sanctum', 'verified'])->get('/atividades/criar_form', [AtividadesController::class, 'atividade_criar_form']);
Route::middleware(['auth:sanctum', 'verified'])->post('/atividades/criar', [AtividadesController::class, 'atividade_criar']);

//rotas mural
Route::middleware(['auth:sanctum', 'verified'])->get('/mural', [MuralController::class, 'mostra_avisos']);
Route::middleware(['auth:sanctum', 'verified'])->get('/mural/marcar_concluido/{id}', [MuralController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'verified'])->get('/mural/form_criar_aviso', [MuralController::class, 'form_aviso_criar']);
Route::middleware(['auth:sanctum', 'verified'])->post('/mural/criar', [MuralController::class, 'criar_aviso']);

//overview
Route::middleware(['auth:sanctum', 'verified'])->get('/overview', [OverviewController::class, 'show']);
Route::middleware(['auth:sanctum', 'verified'])->get('/overview/{id}', [OverviewController::class, 'atividades_show']);



Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

//rotas zaneta

Route::get('/justificativa', function () {
    return view('controle/justificativa');
});
Route::middleware(['auth:sanctum', 'verified'])->post('/justificativa', [JustificativaController::class, 'create']);




