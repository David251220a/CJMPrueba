<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;
use App\pre_Pedido_Refinanciamiento;

class apo_Afiliado_CapacidadController extends Controller
{
    //
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(Request $request){

        $id_user = auth()->id();

        if($request){

            $rol = DB::table('users_config')   
            ->where('Id_User','=',$id_user)
            ->first();

            $id_rol = $rol->Id_Rol;
            $id_departamento = $rol->Id_Departamento;
            $id_institucion_municipal = $rol->Id_InstitucionMunicipal;
            $id_legajo = $rol->Id_Legajo;

            if ($id_rol == 1 || $id_rol == 6) { 

                $afiliado = DB::table('leg_Afiliado')   
                ->where('Id_Legajo','=',$id_legajo)
                ->first();

                $id_dependencia = $afiliado->Dependencia;

                $institucion_municipal = DB::table('apo_Institucion_Municipal')
                ->where('DependenciaCobol','=',$id_dependencia)
                ->first();

                $aporte = DB::table('apo_Aporte')
                ->where('Id_Legajo','=',$id_legajo)
                ->first();

                $aux_aporte = DB::table('apo_Aporte')
                ->select(DB::raw('COUNT(*) as cant'))
                ->where('Id_Legajo','=',$id_legajo)
                ->groupBy('Id_Legajo')
                ->orderby('Id_Legajo')
                ->first();

                $prestamo = DB::table('pre_Cobol_Prestamo')
                ->where('Id_Legajo','=', $id_legajo)
                ->orderby('Secuencia','Asc')
                ->get();

                $aux_prestamo = DB::table('pre_Cobol_Prestamo')
                ->select(DB::raw('COUNT(*) as cant'))
                ->where('Id_Legajo','=', $id_legajo)
                ->groupBy('Id_Legajo')
                ->orderby('Id_Legajo')
                ->first();

                $prestamo_morosidad = DB::table('pre_Cobol_Prestamo_Morosidad')                        
                ->where('Id_Legajo','=', $id_legajo)                        
                ->orderby('Secuencia','Asc')
                ->get();
                
                $aux_prestamo_morosidad = DB::table('pre_Cobol_Prestamo_Morosidad')
                ->select(DB::raw('COUNT(*) as cant'))
                ->where('Id_Legajo','=', $id_legajo)                        
                ->groupBy('Id_Legajo')
                ->orderby('Id_Legajo')
                ->first();

                $pedido_refinanciacion = DB::table('pre_Pedido_Refinanciamento')                        
                ->where('Id_Legajo','=', $id_legajo) 
                ->first();
                                
                return view('afiliado\capacidad.index', ["afiliado"=>$afiliado
                , "institucion_municipal"=>$institucion_municipal
                , "aporte"=>$aporte
                , "aux_aporte"=>$aux_aporte
                , "prestamo"=>$prestamo
                , "pedido_refinanciacion"=>$pedido_refinanciacion
                , "prestamo_morosidad"=>$prestamo_morosidad
                , "aux_prestamo"=>$aux_prestamo
                , "aux_prestamo_morosidad"=>$aux_prestamo_morosidad]);     
            
            }else{

                return redirect('inicio/inicio');

            }           

        }

    }

    public function store(Request $request){

        $id_user = auth()->id();
        $rol = DB::table('users_config')   
        ->where('Id_User','=',$id_user)
        ->first();

        $id_rol = $rol->Id_Rol;
        $id_departamento = $rol->Id_Departamento;
        $id_institucion_municipal = $rol->Id_InstitucionMunicipal;
        $id_legajo = $rol->Id_Legajo;

        if ($id_rol == 1 || $id_rol == 6) { 

            $refinanciacion = new pre_Pedido_Refinanciamiento();
            $refinanciacion->Id_Legajo = $request->get('id_legajo');
            $refinanciacion->Descripcion = $request->get('pobserbacion');
            $refinanciacion->Id_Estado = 'A';
            $refinanciacion->save();

            return redirect('afiliado/capacidad');


        }else{
            
            return redirect('inicio/inicio');

        }

    }
}
