<?php

namespace App\Http\Controllers;

use App\Models\Justificativa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use App\Http\Controllers\Redirect;
use Illuminate\Contracts\Encryption\DecryptException;

class JustificativaController extends Controller
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
        Justificativa::create([
              'users' =>  Auth::user()->id,
              'justificativa' =>  $request['justificativa'],
              'tipo' =>  $request['tipo']
        ]);
  
        return redirect('/justificativa');
      }
}

