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
        $tem = false;
        $results = DB::table('atividades')
            ->join('users', 'users.empresa', '=', 'atividades.empresa')
            ->orderBy('users.pontos_atividades', 'desc')
            ->select('users.*', 'atividades.destinatario', 'atividades.tipo_destinatario', 'atividades.dificuldade')
            ->where('atividades.finalizacao', 'sim')
            ->get();

        $users = User::orderBy('pontos_atividades', 'DESC')->where('ativo', 's')->get();
        $atividades = Atividade::all()->where('finalizacao', 'sim');

        if($results->count() > 0){
            $tem = true;
        }
        return view('users/overview',compact('results', 'tem' ,'users', 'atividades'));
    } 

    public function atividades_show($id){
        $tem_eq = false;
        $tem_ind = false;
        $user_equipe = DB::table('users')->where('id', $id)->value('equipe');
        $nome = DB::table('users')->where('id', $id)->value('name');
        if($user_equipe != null) $nome_equipe = Equipes::find($user_equipe)->value('equipe');
        else $nome_equipe = null;
        $atividade_user = Atividade::all()->where('destinatario', $id)->where('tipo_destinatario', 1)->where('finalizacao', 'sim');
        $atividade_equipe = Atividade::all()->where('destinatario', $user_equipe)->where('tipo_destinatario', 2)->where('finalizacao', 'sim');
        // $overview = array();
        // foreach($atividades as $linha){
        //     if($linha->tipo_destinatario == 1 && $linha->destinatario == $id)
        // }
        // error_log($nome. "uuuuu " . $id);
        if(count($atividade_user) > 0 && count($atividade_equipe) > 0){
            $tem_eq = true;
            $tem_ind = true;
            return view('users/overview_atividades', compact('atividade_user', 'atividade_equipe', 'nome', 'nome_equipe', 'tem_eq', 'tem_ind'));
        }else if(count($atividade_user) == 0 && count($atividade_equipe) > 0){
            $tem_eq = true;
            return view('users/overview_atividades', compact('atividade_user', 'atividade_equipe', 'nome', 'nome_equipe', 'tem_eq', 'tem_ind'));
        }else if(count($atividade_user) > 0 && count($atividade_equipe) == 0){
            $tem_ind = true;
            return view('users/overview_atividades', compact('atividade_user', 'atividade_equipe', 'nome', 'nome_equipe', 'tem_eq', 'tem_ind'));
        }else {
            return redirect()->back();
        }
    } 

    // public function show_own(){
    //     $id = session()->get('id_user');
    //     $usuario = User::find($id);
    //     return view('users/pag_user',compact('usuario'));
    // } 


    //??REA DE GR??FICOS P??G USER-------------------------------------
    public function pag_user(){
        //Gr??fico de ativ em equipes e individuais
            $tem_ind = false;
            $tem_eq = false;
            $tem = false;

            $quant_equipe = 0;
            $equipe = DB::table('users')->where('id', Auth::user()->id)->value('equipe');
            if($equipe != null){
                $array_equipe = Atividade::all()->where('destinatario', $equipe)->where('tipo_destinatario', 2)->where('finalizacao', 'sim')->count();
                if($array_equipe == 0){
                    $quant_equipe = 0;
                }else{
                    $quant_equipe = $array_equipe;
                    $tem_eq = true;
                }
            }
            $quant_ind = 0;
            $array_ind = Atividade::all()->where('destinatario', Auth::user()->id)->where('tipo_destinatario', 1)->where('finalizacao', 'sim')->count();
            if($array_ind == 0){
                $quant_ind = 0;
            }else{
                $quant_ind = $array_ind;
                $tem_ind = true;
            }

            $array_leg = ['Individual', 'Equipe'];
            $array_quant = [$quant_ind, $quant_equipe];

        //Gr??fico de ativ f??ceis, medianas e dif??ceis
            $quant_fac = Atividade::all()->where('destinatario', Auth::user()->id)->where('dificuldade', 1)->where('finalizacao', 'sim')->count();
            $quant_med = Atividade::all()->where('destinatario', Auth::user()->id)->where('dificuldade', 2)->where('finalizacao', 'sim')->count();
            $quant_dif = Atividade::all()->where('destinatario', Auth::user()->id)->where('dificuldade', 3)->where('finalizacao', 'sim')->count();

            $ativ_leg = ['F??cil', 'M??dio', 'Dif??cil'];
            $ativ_quant = [$quant_fac, $quant_med, $quant_dif];

            if($tem_ind || $tem_eq){
                $tem = true;
            }else{
                $tem = false;
            }

        return view('users/pag_user', compact('array_leg', 'array_quant', 'ativ_leg', 'ativ_quant', 'tem'));
    } 
}
