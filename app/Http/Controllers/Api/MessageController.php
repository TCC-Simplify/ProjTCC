<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;
use App\Models\EMenssage;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades;

use App\Events\Chat\SendMessage;
use App\Events\Chat\EqSendMessage;

class MessageController extends Controller
{
    public function listMessages(User $user){
        $userFrom = Auth::user()->id;
        $userTo = $user->id;

        $messages = Message::where(
            function ($query) use ($userFrom, $userTo){
                $query->where([
                    'from' => $userFrom,
                    'to' => $userTo
                ]);
            }
        )->orWhere(
            function ($query) use ($userFrom, $userTo){
                $query->where([
                    'from' => $userTo,
                    'to' => $userFrom
                ]);
            }
        )->orderBy('created_at', 'ASC')->get();

        Message::where(
            function ($query) use ($userFrom, $userTo){
                $query->where([
                    'from' => $userTo,
                    'to' => $userFrom
                ]);
            }
        )->Update([
            'visto' => false
        ]);

        return response()->json([
            'messages' => $messages,
            'tipo' => false
        ], Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->tipo){
            $message = new EMenssage();
            $message->from = Auth::user()->id;
            $message->to = $request->to;
            $message->content = filter_var($request->content, FILTER_SANITIZE_STRIPPED);
            $message->visto = true;
            $message->save();

            //EqSendMessage::dispatch($message, $request->to);
        }
        else{
            $message = new Message();
            $message->from = Auth::user()->id;
            $message->to = $request->to;
            $message->content = filter_var($request->content, FILTER_SANITIZE_STRIPPED);
            $message->visto = true;
            $message->save();

            SendMessage::dispatch($message, $request->to);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
