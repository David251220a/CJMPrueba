<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use App\Vendedores;
use illuminate\Support\Collection;
use Carbon\Carbon;
use Response;
use DB;

class InicioController extends Controller
{
    //


    public function index(Request $request){

        $IdInstitucion = auth()->id();
        $IdVendedor = 0;

        if($request){

            $IdInstitucion =  auth()->id();

            $institucion = DB::table('Institucion_Municipal')
            ->where('IdInstitucion','=',$IdInstitucion)
            ->first();

            $contenido = DB::table('Contenido')
            ->where('IdContenido','=','2')
            ->first();

            $vendedor = DB::table('Vendedores')
            ->where('IdEstado','=','2')
            ->first();

            $IdVendedor = $vendedor->IdVendedor;

            DB::update('pa_Actualizar_IdEstado_Vendedor  ?', array($IdVendedor));

            return view('inicio\inicio',["institucion"=>$institucion, "contenido"=>$contenido, "vendedor"=>$vendedor]);
            /*return view('inicio\inicio',["institucion"=>$institucion, "contenido"=>$contenido]);*/

        }

    }

}
