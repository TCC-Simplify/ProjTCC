<?php

namespace App\Http\Controllers;

use App\Models\Ponto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
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
              'motivo' =>  $request['motivo']
        ]);
  
        return redirect('/mural');
      }
}
