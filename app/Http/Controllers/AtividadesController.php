<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atividade;

class AtividadesController extends Controller
{
    public function atividade_show($id = null, Atividade $atividade)
    {
        if($id == null)
        {
            $ativ = $atividade->all();

            return view('controle.atividades', compact('ativ'));
        }
        else
        {

        }
        return view('controle.atividades');
    }
    

    public function atividade_criar()
    {
        return view('controle.atividades_cadastro');
    }
}
