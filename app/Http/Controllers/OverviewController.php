<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Atividade;
use App\Models\Equipes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;

class OverviewController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $request;
     private $repository;
     private $users;
   
    
    public function __construct(User $users)
    {
        $this->users = $users;
    }
        
    public function show(){
        $users = User::all()->where('ativo', 's');
        $atividades = Atividade::all()->where('finalizacao', 'sim');
        return view('users/overview',compact('users', 'atividades'));
    } 

    public function atividades_show($id){
        $user_equipe = DB::table('users')->where('id', $id)->value('equipe');
        $nome = DB::table('users')->where('id', $id)->value('name');
        if($user_equipe != null) $nome_equipe = Equipes::find($user_equipe)->value('equipe');
        else $nome_equipe = null;
        $atividade_user = Atividade::all()->where('destinatario', $id)->where('tipo_destinatario', 1);
        $atividade_equipe = Atividade::all()->where('destinatario', $user_equipe)->where('tipo_destinatario', 2);
        // $overview = array();
        // foreach($atividades as $linha){
        //     if($linha->tipo_destinatario == 1 && $linha->destinatario == $id)
        // }
        // error_log($nome. "uuuuu " . $id);
        if(count($atividade_user) > 0 || count($atividade_equipe) > 0){
            return view('users/overview_atividades', compact('atividade_user', 'atividade_equipe', 'nome', 'nome_equipe'));
        } else {
            return redirect()->back();
        }
    } 

    // public function show_own(){
    //     $id = session()->get('id_user');
    //     $usuario = User::find($id);
    //     return view('users/pag_user',compact('usuario'));
    // } 


    //ÁREA DE GRÁFICOS PÁG USER-------------------------------------
    public function pag_user(){
        //Gráfico de ativ em equipes e individuais
            $quant_equipe = 0;
            $equipe = DB::table('users')->where('id', Auth::user()->id)->value('equipe');
            if($equipe != null){
                $array_equipe = Atividade::all()->where('destinatario', $equipe)->where('tipo_destinatario', 2)->where('finalizacao', 'sim')->count();
                if($array_equipe == 0){
                    $quant_equipe = 0;
                }else{
                    $quant_equipe = $array_equipe;
                }
            }
            $quant_ind = 0;
            $array_ind = Atividade::all()->where('destinatario', Auth::user()->id)->where('tipo_destinatario', 1)->where('finalizacao', 'sim')->count();
            if($array_ind == 0){
                $quant_ind = 0;
            }else{
                $quant_ind = $array_ind;
            }

            $array_leg = ['Individual', 'Equipe'];
            $array_quant = [$quant_ind, $quant_equipe];

        //Gráfico de ativ fáceis, medianas e difíceis
            $quant_fac = Atividade::all()->where('destinatario', Auth::user()->id)->where('dificuldade', 1)->where('finalizacao', 'sim')->count();
            $quant_med = Atividade::all()->where('destinatario', Auth::user()->id)->where('dificuldade', 2)->where('finalizacao', 'sim')->count();
            $quant_dif = Atividade::all()->where('destinatario', Auth::user()->id)->where('dificuldade', 3)->where('finalizacao', 'sim')->count();

            $ativ_leg = ['Fácil', 'Médio', 'Difícil'];
            $ativ_quant = [$quant_fac, $quant_med, $quant_dif];

        return view('users/pag_user', compact('array_leg', 'array_quant', 'ativ_leg', 'ativ_quant'));
    } 
}
