<?php

namespace App\Http\Controllers;

use App\Models\Ponto;
use App\Models\Justificativa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use App\Http\Controllers\Redirect;
use Illuminate\Contracts\Encryption\DecryptException;

class PontosController extends Controller
{
    protected $request;
    private $repository;

    /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
      public function create(Request $request)
      {        
        Ponto::create([
              'users' =>  Auth::user()->id,
              'motivo' =>  $request['motivo'],
              'entrada_id' => null
        ]);
  
        return redirect('/atividades');
      }

      public function show()
      {        
        $ponto = DB::table('pontos')->where('users', Auth::user()->id)->orderBy('created_at', 'desc')->first();
        $status = '';
        if($ponto->entrada_id == null)
          $status = 'Entrada';
        else
          $status = 'Saída';

        return view('users/dados_ponto', compact('ponto', 'status'));
      }

      public function saida()
      {        

        $saida = DB::table('pontos')->where('users', Auth::user()->id)->orderBy('created_at', 'desc')->first();
        $saida= json_decode( json_encode($saida->id), true);
        Ponto::create(
          [
            'users' =>  Auth::user()->id,
            'motivo' =>  3,
            'entrada_id' => $saida
          ]
        );

        return redirect('/dados_ponto');
      }

      public function historico()
      {        

        $hist = Ponto::all()->where('users', Auth::user()->id);
        $just = Justificativa::all()->where('users', Auth::user()->id);

        return view('users/historico_ponto', compact('hist', 'just'));
      }

      public function confirma()
      {        
        $confirma = DB::table('pontos')->where('users', Auth::user()->id)->orderBy('created_at', 'desc')->first();
        if($confirma->entrada_id == null)
          return view('users/ponto_confirma');  
        else
          return redirect('/logout');
      }

}
