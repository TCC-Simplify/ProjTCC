<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;

use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aux = Auth::user()->aux;

        $ldate = date('Y-m-d');
        $ponto_bd = DB::table('pontos')->where([['users', Auth::user()->empresa],['created_at', 'LIKE', '%'.$ldate.'%']])->value('id');
        $ref = DB::table('pontos')->where([['users', Auth::user()->empresa], ['entrada_id', null]])->orderBy('created_at', 'desc')->first();
        if($ref){    
            $ref= json_decode( json_encode($ref->id), true);
            $saida_bd = DB::table('pontos')->where([['users', Auth::user()->empresa],['entrada_id', $ref]])->value('id');
        }

        $senha_empresa = DB::table('empresas')->where('id', Auth::user()->empresa)->value('senha');
        session()->put('id_empresa', Auth::user()->empresa);
        session()->put('senha_empresa', $senha_empresa);

        if($aux == 1 && (!$ponto_bd || $saida_bd)){
            return view('users/area_ponto');
        }else if($aux == 0){
            return view('users/muda_senha');
        }else if($aux == 1 && ($ponto_bd || !$saida_bd)){
            return redirect('/atividades');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function muda(Request $request)
    {
        User::find(Auth::user()->id)->update([
            'aux' =>  1,
            'password' => Hash::make($request['senha'])
        ]);

        $request->session()->forget('password_hash_web');

        // login the user back with his new updated credentials
        $user = Auth::user();
        Auth::guard('web')->login($user);

        return view('users/area_ponto');
        
    }


}
