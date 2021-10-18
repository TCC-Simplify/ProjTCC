<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Equipes;
use App\Models\Empresa;
use App\Models\Aviso;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MuralController extends Controller
{
    
    public function criar_aviso(Request $request) //aviso é geral so adm cria 
    {
        $id_user = Auth::user()->id;
        $id_empresa = session()->get('id_empresa');
        Aviso::create([
         'titulo' =>  $request['titulo'],
         'descricao' =>  $request['descricao'],
         'responsavel' =>  $id_user,
         'empresa'=> $id_empresa,
         'imagem' =>  $request['imagem'],
         'video' =>  $request['video'],
         'duracao' =>  $request['duracao']
        ] );
        return redirect('/mural');
    }

    public function mostra_avisos($id = null)
    {
        $id_empresa = session()->get('id_empresa');
        $array_aviso = Aviso::all()->where('empresa',$id_empresa)->count();
        if($array_aviso == 0){
            $tem_aviso = false;
        } else {
            $tem_aviso = true;
        }
        

        if($id == null)
        {
            $avisos = Aviso::all()->where('empresa',$id_empresa);
            $user = User::all();

        }else{
            $avisos = Aviso::all()->where('id',$id);
        }
        return view('controle.mural', compact('id','avisos','user', 'tem_aviso'));

    }

    public function form_aviso_criar()
    {
        return view('controle.mural_cadastro');
    }

    public function destroy($id)
    {
        Aviso::find($id)->delete();
        return redirect('/mural');
    }
    
}
