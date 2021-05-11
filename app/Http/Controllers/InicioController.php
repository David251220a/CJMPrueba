<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use App\users_config;
use App\Apo_Institucion_Municipal;
use illuminate\Support\Collection;
use Carbon\Carbon;
use Response;
use DB;

class InicioController extends Controller
{
    //


    public function index(Request $request){

        $id_user = auth()->id();  

        if($request){                        

            $rol = DB::table('users_config')            
            ->where('Id_User','=',$id_user)
            ->first();

            $id_rol = $rol->Id_Rol;
            
            $user_contenido = DB::table('users_config')                
            ->where('Id_User','=',$id_user)                
            ->first();

            $id_departamento = $user_contenido->Id_Departamento;
            $id_institucion_municipal = $user_contenido->Id_InstitucionMunicipal;

            $user_institucion = DB::table('apo_Institucion_Municipal')                
            ->where('Id_Departamento','=',$id_departamento)
            ->where('Id_InstitucionMunicipal','=',$id_institucion_municipal)
            ->first();

            return view('inicio\inicio',["user_contenido"=>$user_contenido, "user_institucion"=>$user_institucion ]);            
            //return view('inicio\inicio',["institucion"=>$institucion, "contenido"=>$contenido, "vendedor"=>$vendedor]);
            /*return view('inicio\inicio',["institucion"=>$institucion, "contenido"=>$contenido]);*/

        }

    }

}
