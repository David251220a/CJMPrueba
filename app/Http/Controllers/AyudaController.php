<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;
use App\Contenido;

class AyudaController extends Controller
{
    //

    public function index(Request $request){

        if($request){

            $query=trim($request->get('searchtext'));
            $contenido = DB::table('Contenido AS a')
            ->select('a.*')
            ->where('a.Tipo_Contenido','=','1')
            ->where('a.Titulo','LIKE','%'.$query.'%')
            ->get();
            return view('ayuda.index',["contenido"=>$contenido, "searchtext"=>$query]);

        }

    }

    public function show($id){

        $contenido = DB::table('Contenido AS a')
        ->select('a.*')
        ->where('a.IdContenido','=',$id)
        ->first();
        return view('ayuda.show',["contenido"=>$contenido]);

    }

}
