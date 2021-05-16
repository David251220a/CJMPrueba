<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;

class pre_Constancia_PrestamoController extends Controller
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

            if ($id_rol != 4 || $id_rol != 1 && $id_rol != 3){
                
                $query=trim($request->get('searchtext'));
            
                $cant_cadena = strlen($query);

                $afiliado = DB::table('leg_Afiliado')
                ->where('Documento','=',$query)
                ->first();                

                $id_legajo = 0;

                if ($cant_cadena >= 5){
                    
                    if (empty($afiliado->Documento)) {
                        
                        $query="";
                        //return view('constancia\aporte.index', ["searchtext"=>$query]);
                        return back()->with('msj', 'No se encuentra al Afiliado con este numero de Cedula.');

                    }else{
                    
                        $id_legajo = $afiliado->Id_Legajo;

                        $afiliado_prestamo = DB::table('pre_Cobol_Prestamo')
                        ->where('Id_Legajo','=', $id_legajo)
                        ->orderby('Secuencia','Asc')
                        ->get();

                        $cont_prestamo = DB::table('pre_Cobol_Prestamo')
                        ->select(DB::raw('COUNT(*) as cant'))
                        ->where('Id_Legajo','=', $id_legajo)
                        ->groupBy('Id_Legajo')
                        ->orderby('Id_Legajo')
                        ->first();

                        $afiliado_prestamo_morosidad = DB::table('pre_Cobol_Prestamo_Morosidad')                        
                        ->where('Id_Legajo','=', $id_legajo)                        
                        ->orderby('Secuencia','Asc')
                        ->get();

                        $cont_prestamo_morosidad = DB::table('pre_Cobol_Prestamo_Morosidad')
                        ->select(DB::raw('COUNT(*) as cant'))
                        ->where('Id_Legajo','=', $id_legajo)                        
                        ->groupBy('Id_Legajo')
                        ->orderby('Id_Legajo')
                        ->first();

                        if (empty($cont_prestamo->cant) && empty($cont_prestamo_morosidad->cant)){

                            return back()->with('msj', 'El Afiliado no cuenta con Prestamos Activos y Cuotas Morosas.');
                        }
                        
                        return view('constancia\prestamo.show', ["afiliado"=>$afiliado
                        , "afiliado_prestamo"=>$afiliado_prestamo
                        , "afiliado_prestamo_morosidad"=>$afiliado_prestamo_morosidad
                        , "cont_prestamo"=>$cont_prestamo
                        , "cont_prestamo_morosidad"=>$cont_prestamo_morosidad]);                        

                    }

                }else{
                    
                    $query="";
                    return view('constancia\prestamo.index', ["searchtext"=>$query]);

                }                  
                                

            }
    
            return redirect('inicio/inicio');
            

        }

    } 

}
