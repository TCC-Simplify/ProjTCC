<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Models\Equipes;
use Symfony\Component\HttpFoundation\Response;

class EquipeController extends Controller
{
    public function index(){
        $userLogged = Auth::user();

        $equipes = Equipes::where('id', '=', $userLogged->equipe)->where('empresa', '=', $userLogged->empresa)->get();

        return response()->json([
            'equipes' => $equipes
        ], Response::HTTP_OK);
    }

    public function show(Equipes $equipe){
        return response()->json([
            'equipe' => $equipe
        ], Response::HTTP_OK);
    }
}
