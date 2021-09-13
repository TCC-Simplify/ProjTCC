<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reuniao;
use App\Models\User;
use App\Models\Equipes;
use App\Models\Empresa;
use App\Models\Aviso;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MuralController extends Controller
{
    public function criar_aviso(Request $request, User $user)
    {
        $id_user = Auth::user()->id;

        Aviso::create([
         'titulo' =>  $request['titulo'],
         'descricao' =>  $request['descricao'],
         'responsavel' =>  $id_user,
         'imagem' =>  $request['imagem'],
         'video' =>  $request['video'],
         'duracao' =>  $request['duracao']

        ] );

        return redirect('/mural');
    }

    public function mostra_avisos()
    {
        $id_user = Auth::user()->id;
        $avisos = Avisos::all()->where('responsavel',$id_user);
        return view('mural/avisos', compact('avisos'));

    }

    public function criar_reuniao(Request $request, User $user)
    {

    }

    public function mostra_reuniao()
    {
        
    }
}
