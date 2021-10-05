<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Equipes;
use App\Models\Empresa;
use App\Models\Aviso;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MuralController extends Controller
{
    
    public function criar_aviso(Request $request) //aviso é geral so adm cria 
    {
        $id_user = Auth::user()->id;
        $id_empresa = session()->get('id_empresa');

        Aviso::create([
         'titulo' =>  $request['titulo'],
         'descricao' =>  $request['descricao'],
         'responsavel' =>  $id_user,
         'empresa'=> $id_empresa,
         'imagem' =>  $request['imagem'],
         'video' =>  $request['video'],
         'duracao' =>  $request['duracao']

        ] );

        return redirect('/mural/avisos');
    }

    public function mostra_avisos()
    {
        $id_empresa = session()->get('id_empresa');
        $avisos = Avisos::all()->where('empresa',$id_empresa);
        return view('controle.mural/avisos', compact('avisos'));

    }

    
    
}
