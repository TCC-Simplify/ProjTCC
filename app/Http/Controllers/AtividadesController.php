<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atividade;
use App\Models\User;
use App\Models\Equipes;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;

class AtividadesController extends Controller
{
    public function atividade_show($id = null, Atividade $atividade, User $user, Equipes $equipe)
    {
        if($id == null)
        {
            $id_empresa = session()->get('id_empresa');
            $ativ = $atividade->all();
            $users = $user->all()->where('empresa',$id_empresa);
            $equipes = $equipe->all();
            $permissao = Auth::user()->permissao;
            $id_user = Auth::user()->id;
            

            return view('controle.atividades', compact('ativ', 'id', 'permissao','id_user', 'users', 'equipes', 'id_empresa'));
        }
        else
        {
            $id_empresa = session()->get('id_empresa');
            $ativ = $atividade->all();
            $users = $user->all()->where('empresa',$id_empresa);
            $equipes = $equipe->all();
            $permissao = Auth::user()->permissao;
            $id_user = Auth::user()->id;
            

            return view('controle.atividades', compact('ativ', 'id', 'permissao','id_user', 'users', 'equipes', 'id_empresa'));
        }
        return view('controle.atividades');
    }
    

    public function atividade_criar(Request $request)
    {
        
    }

    public function atividade_criar_form(User $user, Atividade $atividade)
    {
        $id_empresa = session()->get('id_empresa');
        $users = $user->all()->where('empresa',$id_empresa);
        $id_users = $user->id;
        
        return view('controle.atividades_cadastro', compact('users'));
    }
}
