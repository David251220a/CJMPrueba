<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;

class apo_AporteController extends Controller
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
                        return back()->with('msj', 'No existe Afiliado');

                    }else{
                    
                        $id_legajo = $afiliado->Id_Legajo;

                        $afiliado_cabezera = DB::table('apo_Aporte')
                        ->where('Id_Legajo','=', $id_legajo)
                        ->first();

                        $afiliado_constancia = DB::table('apo_Aporte_Afiliado_Extracto')                        
                        ->where('Id_Legajo','=', $id_legajo)                        
                        ->orderby('Fecha_Aporte','desc')
                        ->get();

                        return view('constancia\aporte.show', ["afiliado"=>$afiliado
                        , "afiliado_constancia"=>$afiliado_constancia
                        , "afiliado_cabezera"=>$afiliado_cabezera]);

                    }

                }else{
                    
                    $query="";
                    return view('constancia\aporte.index', ["searchtext"=>$query]);

                }                  
                                

            }
    
            return redirect('inicio/inicio');
            

        }

    }

}
