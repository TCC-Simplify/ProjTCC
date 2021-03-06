<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;

class UsuarioController extends Controller
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
        
 
     
     public function index()
     {
        $filtro = '';
        if($_GET) $filtro = $_GET['user_filtro'];
        $todos = User::where('empresa', session()->get('id_empresa'))->where('name', 'like', '%' . $filtro . '%')->latest()->paginate(15);
        return view('users/mostrar_todos', [
            'todos' => $todos,
        ]);
     }

     public function mostra()
     {
        $todos = User::where('empresa', session()->get('id_empresa'))->latest()->paginate(15);
        return view('users/des_user', [
            'todos' => $todos,
        ]);
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function create(Request $request)
     {       
        $id = session()->get('id_empresa');
        $senha = session()->get('senha_empresa');

        if(isset($request['permissao']))
        {
            $checkbox = 2;
        }
        else
        {
            $checkbox = 3;
        }

        /*try{

            $dados = $request->validate([
                'cpf' => 'required|cpf',
                // outras validações aqui
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            $e->errors();
            return redirect()->back();
        }*/
        User::create([
             'name' =>  $request['name'],
             'email' =>  $request['email'],
             'cpf' => $request['cpf'],
             'dt_nasc' =>  $request['dt_nasc'],
             'funcao' =>  $request['funcao'],
             'permissao' =>   $checkbox,
             'password' => Hash::make( $senha ),
             'ativo'=> 's',
             'empresa'=> $id,
             'aux' => 0,
             'equipe' => 0,
             'pontos_atividades' => 0
         ]);
 
         return redirect('/users');
     }

     /**
      * 
      *
      * @param  int $id
      * @return \Illuminate\Http\Response
      */

    public function show(){
        $id = session()->get('id_user');
        $usuario = User::find($id);
        
        // carrega o registro (realiza um select e um fetch internamente)
        return view('users/pag_user',compact('usuario'));
    }

    /**
      * 
      *
      * @param  int $id
      * @return \Illuminate\Http\Response
      */

    public function edit($id){
        $usuario = User::find($id);
        // carrega o registro (realiza um select e um fetch internamente)
        return view('users/alt_users',compact('usuario'));
    }

    public function del($id){
        $usuario = User::find($id);
        // carrega o registro (realiza um select e um fetch internamente)
        return view('users/del_users',compact('usuario'));
    }

    public function reativa($id){
        User::find($id)->update([
            'ativo' => 's'
        ]);

        return redirect('/users');
    }

    /**
      * 
      *
      * @param  int $id
      * @return \Illuminate\Http\Response
      */

    public function delete(Request $request, $id)
    {
        $senha_empresa = session()->get('senha_empresa');
        $senha_usuario = DB::table('users')->where('id', $id)->value('password');

        /*$messages = [
            'senha_usuario.numeric' => 'Insira apenas números neste campo.',
            'senha_empresa.required' => 'O campo de senha da empresa é de preenchimento obrigatório!',
            'senha_empresa.numeric' => 'Insira apenas números neste campo.',
        ];
        $validate=validator(decrypt($senha_usuario), $this->$request['password']->rules, $messages);
        
        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput();
        }

        $validate2=validator($senha_empresa, $this->users->rules, $messages);

        if($validate2->fails()){
            return redirect()
                ->back()
                ->withErrors($validate2)
                ->withInput();
        }*/



        if($request['password'] == $senha_empresa || Hash::make($request['password']) == $senha_usuario){
            User::find($id)->update([
                'ativo' => 'n'
            ]);
            return redirect('/users');
        }else{
            return redirect()->back();
        }

    }


    public function update(Request $request, $id)
    {
        $senha_empresa = session()->get('senha_empresa');
        $senha_usuario = DB::table('users')->where('id', $id)->value('password');
        if($request['password'] == $senha_empresa || Hash::make($request['password']) == $senha_usuario){
            User::find($id)->update([
                'name' =>  $request['name'],
                'dt_nasc' =>  $request['dt_nasc'],
                'funcao' =>  $request['funcao'],
                'permissao' =>   $request['permissao'],
            ]);

            return redirect('/users');
        }else{
            return redirect()->back();
        }
    }
}
