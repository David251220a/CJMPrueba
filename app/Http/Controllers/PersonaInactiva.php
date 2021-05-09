<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\AfiliadoInstitucion;
use App\TipoAporte;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;

class PersonaInactiva extends Controller
{
    //
    public function __construct(){

        $this->middleware('auth');

    }


    public function index(Request $request){

        $IdInstitucion = auth()->id();

        if($request){

            $query=trim($request->get('searchtext'));
            $persona = DB::table('persona')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('tipo_persona','=','INACTIVO')
            ->where('IdInstitucion','=',$IdInstitucion)
            ->orwhere('cedula','LIKE','%'.$query.'%')
            ->where('tipo_persona','=','INACTIVO')
            ->where('IdInstitucion','=','1')
            ->orwhere('apellido','LIKE','%'.$query.'%')
            ->where('tipo_persona','=','INACTIVO')
            ->where('IdInstitucion','=',$IdInstitucion)
            ->orderby('idpersona','desc')
            ->paginate(7);
            return view('afiliado\personainactiva.index',["persona"=>$persona, "searchtext"=>$query]);

        }

    }

    public function show($id){



    }

    public function store(Request $request){
    

    }


    public function create(){


    }

    public function edit($id){

    }

    public function update(Request $request, $id){


    }

    public function destroy($id){ 

        $persona=Persona::findOrFail($id);
        $persona->tipo_persona='AFILIADO';
        $persona->update();

        return redirect('afiliado/personainactiva');

    }


}
