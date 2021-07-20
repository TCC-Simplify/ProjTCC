<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/welcome', function () {
    return view('welcome');
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


Route::get('/log', 'LogController@index');
Route::post('/log/muda_senha', 'LogController@muda');

//rotas usuario
Route::get('/cadastro_user',function(){
    return view('users/cad_users');
});
Route::post('/cad_user', 'UsuarioController@create');
Route::get('/users', 'UsuarioController@index');
Route::get('/users_des', 'UsuarioController@mostra');

Route::get('/pag_user', 'UsuarioController@show');

Route::get('/alt_user/{id}', 'UsuarioController@edit');
Route::get('/del_user/{id}', 'UsuarioController@del');
Route::get('/rea_user/{id}', 'UsuarioController@reativa');

Route::post('/update_user/{id}', 'UsuarioController@update');
Route::post('/delete_user/{id}', 'UsuarioController@delete');

//Rotas Empresa
Route::get('/empresa', 'EmpresaController@show');
Route::get('/cadastro', 'EmpresaController@create');
Route::post('/cadastro_empresa', 'EmpresaController@store');

Route::get('/editar_empresa/{id}', 'EmpresaController@edit');
Route::get('/del_empresa/{id}', 'EmpresaController@mostra');

Route::post('/update_empresa/{id}', 'EmpresaController@update');
Route::post('/delete_empresa/{id}', 'EmpresaController@delete');

//Rotas Equipe
Route::get('/equipes', 'EmpresaController@equipe_show_all');
Route::get('/form_criar_equipe', 'EmpresaController@equipe_create_form');
Route::post('/criar_equipe', 'EmpresaController@equipe_create');
Route::post('/deletar_equipe', 'EmpresaController@equipe_delete');

Route::get('/equipe/{nome}', 'EmpresaController@equipe_show');
Route::get('/equipe/add/{nome}', 'EmpresaController@equipe_add_form');
Route::post('/equipe/add/processing/{nome}', 'EmpresaController@equipe_add');

Route::post('/equipe/delete', 'EmpresaController@equipe_remove');

//rotas zaneta
Route::get('/area_ponto', function () {
    return view('users/area_ponto');
});
Route::post('/ponto', 'PontosController@create');

//Mural
Route::get('/mural', function () {
    return view('controle/mural');
});

//Atividades
Route::get('/atividades', function () {
    return view('controle/atividades');
});

