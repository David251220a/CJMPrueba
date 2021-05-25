<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DB;
use Response;
use Barryvdh\DomPDF\Facade AS PDF;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\tmp_apo_Rendicion_Aporte_Importar;
use App\Imports\Apo_Rendicion_AporteImport;
use App\Http\Controllers\Storage;

class apo_Rendicion_Aporte_ImportarController extends Controller
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
                
                return view('rendicionaporte\importar.index',["rendicion_aporte"=>$rendicion_aporte]);
            
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
            
            $institucion_municipal =DB::table('apo_Institucion_Municipal')   
            ->where('Id_Departamento','=',$id_departamento)
            ->where('Id_InstitucionMunicipal','=',$id_institucion_municipal)
            ->first();
            return view('rendicionaporte\importar.create',["institucion_municipal"=>$institucion_municipal]);

        }else{

            return redirect('inicio/inicio');

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
        $fecha_aporte = $request->get('fecha');
        $date = Carbon :: now ();

        $date1 = Carbon::parse($fecha_aporte)->format('d-m-Y');
        $fechaComoEntero = strtotime($date1);
        $año = date("Y", $fechaComoEntero);
        $mes = date("m", $fechaComoEntero);
        
        $fecha_validacion = "01-".$mes."-".$año;
        $fecha_validacion_1 = Carbon::parse($fecha_validacion);        
        $fecha_validacion_1 = $fecha_validacion_1->addMonth(1);
        $fecha_validacion_1 = $fecha_validacion_1->subDay(1);

        $date2 = Carbon::parse($fecha_validacion_1)->format('d-m-Y');

        if ($id_rol == 2 || $id_rol == 1) {

            $rendicion_existe = DB::table('apo_Rendicion_Aporte')
            ->where('Id_Departamento','=', $id_departamento)
            ->where('Id_InstitucionMunicipal','=', $id_institucion_municipal)
            ->where('Fecha_Aporte','=',$fecha_aporte)
            ->first();

            if ($date1 != $date2){

                return back()->with('msj', 'La Fecha de Aporte debe de ser el ultimo dia del mes.!!!');

            }

            if (empty($rendicion_existe->Fecha_Aporte)) {
            
            }else{

                return back()->with('msj', 'Ya existe Rendicion de Aporte con esta fecha.!!!');

            }

            $file = $request->file('excel');
            $fecha = $request->get('fecha');
            $nombre= $file->getClientOriginalName();
            Excel::import(new Apo_Rendicion_AporteImport, $file);

            return redirect('rendicionaporte/importar');


        }else{

            return redirect('inicio/inicio');

        }

    }

}
