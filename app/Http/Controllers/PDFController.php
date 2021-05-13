<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use Barryvdh\DomPDF\Facade AS PDF;
use DB;

class PDFController extends Controller
{
    //
    public function __construct(){

        $this->middleware('auth');

    }

    public function ConstanciaAporte($id){

        $id_user = auth()->id();
        $rol = DB::table('users_config')   
        ->where('Id_User','=',$id_user)
        ->first();                  

        $id_rol = $rol->Id_Rol;
        
        if ($id_rol != 4 || $id_rol != 1){

            $afiliado = DB::table('leg_Afiliado')   
            ->where('Id_Legajo','=',$id)
            ->first();

            $afiliado_cabezera = DB::table('apo_Aporte')
            ->where('Id_Legajo','=', $id)
            ->first();

            $afiliado_constancia = DB::table('apo_Aporte_Afiliado_Extracto')                        
            ->where('Id_Legajo','=', $id)                        
            ->orderby('Fecha_Aporte','desc')
            ->get();
            
            $PDF = PDF::loadView('pdf\constanciaaporte',["afiliado"=>$afiliado
            , "afiliado_constancia"=>$afiliado_constancia
            , "afiliado_cabezera"=>$afiliado_cabezera]);   
            //return $PDF->download();
            return $PDF->stream();
        }
    }
}
