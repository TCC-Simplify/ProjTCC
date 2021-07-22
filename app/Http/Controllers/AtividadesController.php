<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atividade;
use App\Models\User;
use App\Models\Equipes;
use Illuminate\Support\Facades\Auth;

class AtividadesController extends Controller
{
    public function atividade_show($id = null, Atividade $atividade, User $user, Equipes $equipe)
    {
        if($id == null)
        {
            $ativ = $atividade->all();
            $users = $user->all();
            $equipes = $equipe->all();
            $permissao = Auth::user()->permissao;
            $id_user = Auth::user()->id;
            

            return view('controle.atividades', compact('ativ', 'id', 'permissao','id_user', 'users', 'equipes'));
        }
        else
        {
            $ativ = $atividade->all();
            $users = $user->all();
            $equipes = $equipe->all();
            $permissao = Auth::user()->permissao;
            $id_user = Auth::user()->id;
            

            return view('controle.atividades', compact('ativ', 'id', 'permissao','id_user', 'users', 'equipes'));
        }
        return view('controle.atividades');
    }
    

    public function atividade_criar()
    {
        return view('controle.atividades_cadastro');
    }
}
