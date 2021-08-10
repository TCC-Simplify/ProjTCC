<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;

class FullCalendarController extends Controller
{
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Eventos::whereDate('inicio', '>=', $request->inicio)
                       ->whereDate('fim',   '<=', $request->fim)
                       ->get(['id', 'titulo', 'inicio', 'fim']);
            return response()->json($data);
    	}
    	return view('full-calender');
    }

    
    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Eventos::create([
    				'titulo'		=>	$request->titulo,
    				'inicio'		=>	$request->inicio,
    				'fim'		=>	$request->fim
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Eventos::find($request->id)->update([
    				'titulo'		=>	$request->titulo,
    				'inicio'		=>	$request->inicio,
    				'fim'		=>	$request->fim
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Eventos::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }
}


?>
