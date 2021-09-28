<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reuniao;
use App\Models\User;
use App\Models\Equipes;
use App\Models\Empresa;
use App\Models\Aviso;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MuralController extends Controller
{
    public function criar_aviso(Request $request) //aviso é geral
    {
        $id_user = Auth::user()->id;

        Aviso::create([
         'titulo' =>  $request['titulo'],
         'descricao' =>  $request['descricao'],
         'responsavel' =>  $id_user,
         'imagem' =>  $request['imagem'],
         'video' =>  $request['video'],
         'duracao' =>  $request['duracao']

        ] );

        return redirect('/mural/avisos');
    }

    public function mostra_avisos()
    {
        $id_user = Auth::user()->id;
        $avisos = Avisos::all()->where('responsavel',$id_user);
        return view('controle.mural/avisos', compact('avisos'));

    }

    public function criar_form_reuniao(User $user, Equipes $equipe)
    {
        $id_empresa = session()->get('id_empresa');
        $users = $user->all()->where('empresa',$id_empresa);
        $equipes = $equipe->all()->where('empresa',$id_empresa);

        return view('controle.mural/reuniao_cad', compact('users','equipes'));
    }

    public function criar_reuniao(Request $request)
    {
        $id_user = Auth::user()->id; //id do resposnavel pela reuniao
        Reuniao::create([
            'reuniao' =>  $request['titulo'],
            'descricao' =>  $request['descricao'],
            'destinatario' =>  $request['destinatario'],
            'responsavel' =>  $id_user,
            'tipo_destinatario' =>  $request['tipo_destinatario'],
            'data' =>  $request['data'],
            'horario' =>  $request['horario']

        ]);

        return redirect('controle.mural/reunioes');
    }

    public function mostra_reuniao(User $user, Reuniao $reuniao, Equipes $equipes )
    {
        $id_user = Auth::user()->id;
        
    }

    
}
