<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Empresa;
use App\Models\Equipes;
use App\Models\Atividade;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;

class EmpresaController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $request;
    private $repository;

    public function __construct(Empresa $empresa)
    {
        $this->empresa = $empresa;
    }

    
    
    public function index()
    {
        //
    }
    
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('empresa/cadastro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        /*$mensagens= [
            'nome.required'=> 'o nome é obrigatorio!',
            'cnpj.required'=> 'o CNPJ é obrigatorio',
            'senha.min'=> 'A senha deve ter no mínimo 8 caracteres'
        ];
        
       $validate= validator($request, $this->empresa->rules, $mensagens);
       if($validate->fails()){
           return redirect()->back()
           ->withErrors($validate)
           ->withInput();

       }*/
       try{

        $dados = $request->validate([
            'cnpj' => 'required|cnpj',
            // outras validações aqui
        ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $e->errors();
            return redirect()->back();
            
            
        }
        Empresa::create([
            'nome' =>  $request['nome'],
            'cnpj' => $request['cnpj'],
            'cep' =>  $request['cep'],
            'rua' =>  $request['rua'],
            'cidade' =>  $request['cidade'],
            'bairro' =>  $request['bairro'],
            'numero' =>  $request['numero'],
            'complemento' =>  $request['complemento'],
            'estado' =>  $request['estado'],
            'senha' => $request['senha'],
            'ativo'=> 's'
        ]);

        $id_empresa = DB::table('empresas')->where('cnpj', $request['cnpj'])->value('id');
        session()->put('id_empresa', $id_empresa);
        session()->put('senha_empresa', $request['senha']);

        return view('/auth/register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(){
        $id = session()->get('id_empresa');
        $empresa = Empresa::find($id);
        $msg=Helper::GetCustomMsg();
         return view('empresa/empresa',[
             'empresa'=>$empresa,
             'msg'=>$msg
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa= Empresa::find($id);
        if(!$empresa)
        {
            return redirect()->back();
        }
        return view('empresa/alterar_dados_empresa',compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostra($id)
    {
        $empresa= Empresa::find($id);
        if(!$empresa)
        {
            return redirect()->back();
        }
        return view('empresa/deleta_dados_empresa',compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $senha_empresa = session()->get('senha_empresa');

        if($request['password'] == $senha_empresa){
           Empresa::find($id)->update([
                'nome' =>  $request['nome'],
                'cep' => $request['cep'],
                'rua' =>  $request['rua'],
                'cidade' =>  $request['cidade'],
                'bairro' =>   $request['bairro'],
                'numero' =>   $request['numero'],
                'estado' =>   $request['estado'],
                'complemento' =>   $request['complemento'],
            ]);
            Helper::setCustomMsg(['msg-success', 'Alterado com sucesso!']);

            return redirect('/empresa');
        }else{
            //mensagemde erro
            return redirect()->back();
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete(Request $request, $id)
     {
         $senha_empresa = session()->get('senha_empresa');

         if($request['password'] == $senha_empresa ){
             Empresa::find($id)->update([
                 'ativo' => 'n'
             ]);
             return  redirect()->route('logout');
         }
            else
             //colocar a mensagem de erro 
             return redirect()->back();
         
 
     }

    //  public function equipe_show(){
    //     $equipes = Equipes::find();
    //     if(!$equipes)
    //     { 
    //         return redirect()->back();
    //     }
    //     return view('empresa/equipes',compact('equipes'));
    // }

    public function equipe_show($nome){
        $id_equipe = DB::table('equipes')->where('equipe', $nome)->value('id');
        $usuarios = User::all()->where('equipe', $id_equipe);
        if(!$usuarios)
        {
            return redirect()->back();
        }

        //Gráfico de ativ fáceis, medianas e difíceis
        $tem_eq = false;
        $conta = Atividade::all()->where('destinatario', $id_equipe)->where('tipo_destinatario', 2)->where('finalizacao', 'sim')->count();
        if($conta > 0){
            $tem_eq = true;
        }
        $quant_fac = Atividade::all()->where('destinatario', $id_equipe)->where('tipo_destinatario', 2)->where('dificuldade', 1)->where('finalizacao', 'sim')->count();
        $quant_med = Atividade::all()->where('destinatario', $id_equipe)->where('tipo_destinatario', 2)->where('dificuldade', 2)->where('finalizacao', 'sim')->count();
        $quant_dif = Atividade::all()->where('destinatario', $id_equipe)->where('tipo_destinatario', 2)->where('dificuldade', 3)->where('finalizacao', 'sim')->count();

        $ativ_leg = ['Fácil', 'Médio', 'Difícil'];
        $ativ_quant = [$quant_fac, $quant_med, $quant_dif];

        return view('empresa/equipe_dados', compact('usuarios', 'ativ_leg', 'ativ_quant', 'tem_eq'))->with('nome', $nome);
    }

    public function equipe_show_all(){
        $filtro = '';
        if($_GET){
            $filtro = $_GET['equipe_filtro'];
            $equipes = Equipes::where('empresa', session()->get('id_empresa'))->where('equipe', 'like', '%' . $filtro . '%')->where('ativo','s')->latest()->paginate(15);//->latest()->paginate(15)
        } else {
            $equipes = Equipes::all()->where('ativo', 's');
        }
        if(!$equipes)
        {
            return redirect()->back();
        }

        $tem = true;
        if($equipes->count() == 0){
            $tem = false;
        }

        return view('empresa/equipes',compact('equipes', 'tem'));
    }

    public function equipe_create_form(){
        $filtro = '';
        if(session('user_filtro')) $filtro = session('user_filtro');
        $usuarios = User::all()->where('ativo', 's');
        $nome_equipe = session('nome');
        echo "<script>console.log('Nome da equipe: ".$nome_equipe."')</script>";
        if(!$usuarios)
        {
            return redirect()->back();
        }
        return view('empresa/equipes_cadastro', compact('usuarios', 'filtro', 'nome_equipe'));
    }

    public function equipe_create(Request $request){
        if(!$request['filter']){
            $users = count($request['users']);
            $vuser = $request['users'];

            $id_empresa = session()->get('id_empresa');
            Equipes::create([
                'aux' =>  1,
                'equipe' => $request['nome'],
                'ativo' =>  's',
                'empresa' =>  $id_empresa,
            ]);
            $id_equipe = DB::table('equipes')->where('equipe', $request['nome'])->value('id');

            for($i=0; $i < $users; $i++){
                User::find($vuser[$i])->update([
                    'equipe' => $id_equipe
                ]);
            }

            return redirect('/equipes');
        } else {
            return redirect('/form_criar_equipe')->with('user_filtro', $request['user_filtro'])->with('nome', $request['nome']);
        }
    }

    public function equipe_delete(Request $request){
        Equipes::find($request['equipe'])->update([
            'ativo' => 'n'
        ]);
        User::where('equipe', $request['equipe'])->update([
            'equipe' => 0
        ]);
        
        return redirect()->back();
    }

    public function equipe_add_form($nome){
        $filtro = '';
        if($_GET) $filtro = $_GET['user_filtro'];
        $id_equipe = DB::table('equipes')->where('equipe', $nome)->value('id');
        $usuarios = User::all()->where('equipe', '!=', $id_equipe)->where('ativo', 's');
        return view('empresa/equipe_add', compact('usuarios', 'nome', 'filtro'))->with('nome', $nome);
    }

    public function equipe_add(Request $request, $nome){
        $users = count($request['users']);
        $vuser = $request['users'];

        $id_equipe = DB::table('equipes')->where('equipe', $nome)->value('id');
        for($i=0; $i < $users; $i++){
            User::find($vuser[$i])->update([
                'equipe' => $id_equipe
            ]);
        }

        return redirect('/equipe/'.$nome);
    }

    public function equipe_remove(Request $request){
        User::find($request['usuario'])->update([
            'equipe' => 0
        ]);

        return redirect()->back();
    }
}
