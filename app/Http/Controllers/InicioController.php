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
            
            if($id_rol == 1){
                 
                return redirect('afiliado/persona');

            }

            if($id_rol == 2){
                 
                return redirect('rendicionaporte/generar');

            }

            if($id_rol == 3 || $id_rol == 4 ){
                 
                return redirect('resumen/aporte');

            }
            

        }

    }

}
