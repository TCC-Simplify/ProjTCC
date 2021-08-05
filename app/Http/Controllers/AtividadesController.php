<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atividade;
use App\Models\User;
use App\Models\Equipes;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AtividadesController extends Controller
{

    // protected $at;    

    // public function __construct(Atividade $at)
    // {
    //     $this->at = $at;
    // }


    public function atividade_show($id = null, Atividade $atividade, User $user, Equipes $equipe)
    {
        if($id == null)
        {
            $id_empresa = session()->get('id_empresa');
            $ativ = $atividade->all();
            $users = $user->all()->where('empresa',$id_empresa);
            $equipes = $equipe->all()->where('ativo','s');
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

    public function atividade_funcs_show($id = null, Atividade $atividade, User $user, Equipes $equipe)
    {
        if($id == null)
        {
            $id_empresa = session()->get('id_empresa');
            $ativ = $atividade->all();
            $users = $user->all()->where('empresa',$id_empresa);
            $equipes = $equipe->all();
            $permissao = Auth::user()->permissao;
            $id_user = Auth::user()->id;
            

            return view('controle.atividades_funcs', compact('ativ', 'id', 'permissao','id_user', 'users', 'equipes', 'id_empresa'));
        }
        else
        {
            $id_empresa = session()->get('id_empresa');
            $ativ = $atividade->all();
            $users = $user->all()->where('empresa',$id_empresa);
            $equipes = $equipe->all();
            $permissao = Auth::user()->permissao;
            $id_user = Auth::user()->id;
            

            return view('controle.atividades_funcs', compact('ativ', 'id', 'permissao','id_user', 'users', 'equipes', 'id_empresa'));
        }
        return view('controle.atividades_funcs');
    }
    

    public function atividade_criar(Request $request, Atividade $atividade)
    {
        // $this->atividade->
        // dd($request->all());
        // dd($request->only(['nome', 'destinatario']));
        // dd($request->except(['_token']));
        // dd($request->input('nome'));
        $dataForm = $request->except(['_token','botao']);
        $insert = $atividade->insert($dataForm);
        if($insert)
        {
            return redirect('/atividades');
        }

    }

    public function atividade_criar_form(User $user, Atividade $atividade, Equipes $equipe)
    {
        $id_empresa = session()->get('id_empresa');
        $users = $user->all()->where('empresa',$id_empresa);
        $equipes = $equipe->all()->where('empresa',$id_empresa);
        
        return view('controle.atividades_cadastro', compact('users', 'equipes'));
    }


    public function marcar_concluido($id)
    {
        Atividade::find($id)->update([
            'finalizacao' => 'sim'
        ]);
        return redirect('/atividades');
    }
}
