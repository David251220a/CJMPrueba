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
            
            
            if ($id_rol == 2 || $id_rol == 1) {
            
                $rendicion_aporte = DB::table('apo_Rendicion_Aporte AS a')
                ->join('apo_Situacion AS b','b.Id_Situacion','=','a.Id_Situacion')
                ->select('a.*', 'b.Desc_Situacion')
                ->where('a.Id_Departamento','=',$id_departamento)
                ->where('a.Id_InstitucionMunicipal','=',$id_institucion_municipal)
                ->where('a.Estado','=','A')
                ->orderby('Fecha_Aporte','desc')
                ->paginate(7);
                
                return view('rendicionaporte\generar.index',["rendicion_aporte"=>$rendicion_aporte]);
            
            }else{

                return redirect('inicio/inicio');

            }                            

        }

    }

    public function create(){

        $id_user = auth()->id();

        $rol = DB::table('users_config')   
        ->where('Id_User','=',$id_user)
        ->first();

        $id_rol = $rol->Id_Rol;
        $id_departamento = $rol->Id_Departamento;
        $id_institucion_municipal = $rol->Id_InstitucionMunicipal;

        if ($id_rol == 2 || $id_rol == 1) {

            $rendicion = DB::table('apo_Afiliado_Inst_Munic AS a')
            ->join('leg_Afiliado AS b','b.Id_Legajo','=','a.Id_Legajo')
            ->select('a.*'
            , 'b.Documento'
            , 'b.Nombre'
            , 'b.Apellido')            
            ->where('a.Id_Departamento', '=', $id_departamento)
            ->where('a.Id_InstitucionMunicipal', '=', $id_institucion_municipal)
            ->where('a.Id_Afiliado_Tipo', '=', 1)
            ->get();

            return view('rendicionaporte\generar.create',["rendicion"=>$rendicion]);

        }else{

            return redirect('inicio/inicio');

        }

    }


}
