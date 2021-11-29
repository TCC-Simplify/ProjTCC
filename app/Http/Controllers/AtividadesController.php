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
        $array_equipe = Atividade::all()->where('destinatario', Auth::user()->equipe)->where('tipo_destinatario', 2)->where('finalizacao', 'Confirmar')->count();
        if($array_equipe == 0){
            $tem_eq = false;
        }else{
            $tem_eq = true;
        }

        $array_ind = Atividade::all()->where('destinatario', Auth::user()->id)->where('tipo_destinatario', 1)->where('finalizacao', 'Confirmar')->count();
        if($array_ind == 0){
            $tem_ind = false;
        }else{
            $tem_ind = true;
        }

        if($id == null)
        {
            $id_empresa = session()->get('id_empresa');
            $ativ = $atividade->orderBy('prazo')->get();
            $users = $user->all()->where('empresa',$id_empresa);
            $equipes = $equipe->all()->where('ativo','s');
            $permissao = Auth::user()->permissao;
            $id_user = Auth::user()->id;
            

            return view('controle.atividades', compact('ativ', 'id', 'permissao','id_user', 'users', 'equipes', 'id_empresa','tem_eq', 'tem_ind'));
        }
        else
        {
            $id_empresa = session()->get('id_empresa');
            $ativ = $atividade->orderBy('prazo')->get();
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
        $array_equipe = Atividade::all()->where('destinatario', '!=', Auth::user()->equipe)->where('tipo_destinatario', 2)->where('finalizacao', 'Confirmar')->where('empresa', Auth::user()->empresa)->count();
        if($array_equipe == 0){
            $tem_eq = false;
        }else{
            $tem_eq = true;
        }

        $array_ind = Atividade::all()->where('destinatario', '!=', Auth::user()->id)->where('tipo_destinatario', 1)->where('finalizacao', 'Confirmar')->where('empresa', Auth::user()->empresa)->count();
        if($array_ind == 0){
            $tem_ind = false;
        }else{
            $tem_ind = true;
        }

        if($id == null)
        {            
            $id_empresa = session()->get('id_empresa');
            $ativ = $atividade->orderBy('prazo')->get();
            $users = $user->all()->where('empresa',$id_empresa);
            $equipes = $equipe->all();
            $permissao = Auth::user()->permissao;
            $id_user = Auth::user()->id;
            

            return view('controle.atividades_funcs', compact('ativ', 'id', 'permissao','id_user', 'users', 'equipes', 'id_empresa', 'tem_eq', 'tem_ind'));
        }
        else
        {
            $id_empresa = session()->get('id_empresa');
            $ativ = $atividade->orderBy('prazo')->get();
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
        $dataForm += ["empresa" => Auth::user()->empresa];
        $insert = $atividade->insert($dataForm);
        if($insert)
        {
            return redirect('/atividades');
        }

    }

    public function atividade_criar_form(User $user, Atividade $atividade, Equipes $equipe)
    {
        $id_empresa = session()->get('id_empresa');
        $users = $user->all()->where('empresa',$id_empresa)->where('ativo', 's');
        $equipes = $equipe->all()->where('empresa',$id_empresa)->where('ativo', 's');
        
        return view('controle.atividades_cadastro', compact('users', 'equipes'));
    }


    public function marcar_concluido($id)
    {
        $soma = 0;
        $atividade = Atividade::find($id);
        if($atividade->tipo_destinatario == 1){
            $user = User::find($atividade->destinatario);

            if($atividade->dificuldade == 1){
                $soma = $user->pontos_atividades + 1;
                User::find($user->id)->update([
                    'pontos_atividades' => $soma
                ]);
            }else if($atividade->dificuldade == 2){
                $soma = $user->pontos_atividades + 2;
                User::find($user->id)->update([
                    'pontos_atividades' => $soma
                ]);
            }else{
                $soma = $user->pontos_atividades + 3;
                User::find($user->id)->update([
                    'pontos_atividades' => $soma
                ]);
            }
        }else{
            $users = DB::table('users')
            ->select('users.*')
            ->where('equipe', $atividade->destinatario)
            ->get();

            foreach($users as $user){
                if($atividade->dificuldade == 1){
                    $soma = $user->pontos_atividades + 1;
                    User::find($user->id)->update([
                        'pontos_atividades' => $soma
                    ]);
                }else if($atividade->dificuldade == 2){
                    $soma = $user->pontos_atividades + 2;
                    User::find($user->id)->update([
                        'pontos_atividades' => $soma
                    ]);
                }else{
                    $soma = $user->pontos_atividades + 3;
                    User::find($user->id)->update([
                        'pontos_atividades' => $soma
                    ]);
                }
            }
        }

        Atividade::find($id)->update([
            'finalizacao' => 'sim'
        ]);

        return redirect('/atividades');
    }
}
