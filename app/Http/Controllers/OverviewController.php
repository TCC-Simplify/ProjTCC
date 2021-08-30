<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Atividade;
use App\Models\Equipes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
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
        $atividades = Atividade::all()->where('finalizacao', 'Confirmar');
        return view('users/overview',compact('users', 'atividades'));
    } 

    public function atividades_show($id){
        $user_equipe = DB::table('users')->where('id', $id)->value('equipe');
        $nome = DB::table('users')->where('id', $id)->value('name');
        if($user_equipe != null) $nome_equipe = Equipes::find($user_equipe)->value('equipe');
        else $nome_equipe = null;
        $atividade_user = Atividade::all()->where('destinatario', $id);
        $atividade_equipe = Atividade::all()->where('destinatario', $user_equipe);
        // $overview = array();
        // foreach($atividades as $linha){
        //     if($linha->tipo_destinatario == 1 && $linha->destinatario == $id)
        // }
        error_log($nome. "uuuuu " . $id);
        return view('users/overview_atividades', compact('atividade_user', 'atividade_equipe', 'nome', 'nome_equipe'));
    } 

    // public function show_own(){
    //     $id = session()->get('id_user');
    //     $usuario = User::find($id);
    //     return view('users/pag_user',compact('usuario'));
    // } 
     
}
