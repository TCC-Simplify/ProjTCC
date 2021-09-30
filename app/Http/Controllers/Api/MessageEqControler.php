<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\equipe;
use App\Models\Equipes;
use App\Models\EMenssage;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades;

class MessageEqControler extends Controller
{
    public function listMessages(Equipes $equipe){
        $equipeFrom = Auth::user()->id;
        $equipeTo = $equipe->id;

        $messages = EMenssage::select(
            "e_menssages.*",
            "users.name"
        )
        ->join("users", "users.id", "=", "e_menssages.from")
        ->where(
            function ($query) use ($equipeTo){
                $query->where([
                    'to' => $equipeTo
                ]);
            }
        )->orderBy('e_menssages.created_at', 'ASC')->get();

        /*EMenssage::where(
            function ($query) use ($equipeFrom, $equipeTo){
                $query->where([
                    'from' => $equipeTo,
                    'to' => $equipeFrom
                ]);
            }
        )->Update([
            'visto' => false
        ]);*/

        return response()->json([
            'messages' => $messages,
            'tipo' => true
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new EMenssage();
        $message->from = Auth::user()->id;
        $message->to = $request->to;
        $message->content = filter_var($request->content, FILTER_SANITIZE_STRIPPED);
        $message->visto = true;
        $message->save();
    }
}
