<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use illuminate\Support\Collection;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade AS PDF;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Apo_Rendicion_Aporte;

class apo_Rendicion_AporteController extends Controller
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

            if ($id_rol != 4 && $id_rol != 5){
            
                if ($id_rol == 2) {
                
                    $rendicion_aporte = DB::table('apo_Rendicion_Aporte AS a')
                    ->join('apo_Situacion AS b','b.Id_Situacion','=','a.Id_Situacion')
                    ->select('a.*', 'b.Desc_Situacion')
                    ->where('a.Id_Departamento','=',$id_departamento)
                    ->where('a.Id_InstitucionMunicipal','=',$id_institucion_municipal)
                    ->where('a.Estado','=','A')
                    ->orderby('Fecha_Aporte','desc')
                    ->paginate(7);
                    
                    return view('rendicionaporte\generar.index',["rendicion_aporte"=>$rendicion_aporte]);
                
                }

                if ($id_rol == 1 || $id_rol == 3 ) {

                    $rendicion_aporte = DB::table('apo_Rendicion_Aporte AS a')
                    ->join('apo_Situacion AS b','b.Id_Situacion','=','a.Id_Situacion')
                    ->select('a.*', 'b.Desc_Situacion')
                    ->where('a.Id_Departamento','=',$id_departamento)                    
                    ->where('a.Estado','=','A')
                    ->orderby('Fecha_Aporte','desc')
                    ->paginate(7);
                    
                    return view('rendicionaporte\generar.index',["rendicion_aporte"=>$rendicion_aporte]);
                
                }

                if ($id_rol == 4 || $id_rol == 5) {                   
                    
                    return redirect('inicio/inicio');
                
                }
                
            }                

        }

    }


}
