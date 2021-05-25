<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apo_Rendicion_Aporte;
use App\Apo_Aporte_Afiliado;
use App\Apo_Institucion_Municipal;
use Carbon\Carbon;
use DateTime;
use DB;
use Response;
use Barryvdh\DomPDF\Facade AS PDF;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Collection;


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

                return back()->with('msj', 'La Fecha de Planilla debe de ser el ultimo dia del mes.!!!');

            }

            if (empty($rendicion_existe->Fecha_Aporte)) {

                

            }else{

                return back()->with('msj', 'Ya existe Rendicion de Aporte con esta fecha.!!!');

            }

            try {
        
                DB::beginTransaction();                                                
                
                $rendicion = new Apo_Rendicion_Aporte();
                $rendicion->Fecha_Aporte = $request->get('fecha');
                $rendicion->Id_Departamento = $id_departamento;
                $rendicion->Id_InstitucionMunicipal = $id_institucion_municipal;
                $rendicion->Cantidad_Persona = str_replace('.', '', $request->get('cantidad'));
                $rendicion->Total_Salario = str_replace('.', '', $request->get('total_salario'));
                $rendicion->Total_Salario_Bonificacion = str_replace('.', '', $request->get('total_bonificacion'));
                $rendicion->Total_Aporte_Personal = str_replace('.', '', $request->get('total_aporte'));
                $rendicion->Total_Aporte_Bonificacion = str_replace('.', '', $request->get('total_aporte_bonificacion'));
                $rendicion->Total_Primera_Asignacion = str_replace('.', '', $request->get('total_primera_asig'));
                $rendicion->Total_Diferencia_Asignacion = str_replace('.', '', $request->get('total_diferencia_asig'));
                $rendicion->Total_RSA = str_replace('.', '', $request->get('total_rsa'));
                $rendicion->Fecha_Alta = $date;
                $rendicion->Estado = "A";
                $rendicion->Id_Situacion = 1;
    
                $rendicion->save();
                
                $id_afiliado_institucion = $request->get('id_afiliado_institucion');
                $salario = str_replace('.', '', $request->get('salario'));                
                $salario_bonificacion = str_replace('.', '', $request->get('salario_bonificacion'));
                $aporte_salario = str_replace('.', '', $request->get('aporte_salario'));
                $aporte_bonficacion = str_replace('.', '', $request->get('aporte_bonificacion'));
                $primera_asignacion = str_replace('.', '', $request->get('primera_asig'));
                $diferencia_asignacion = str_replace('.', '', $request->get('diferencia_asig'));
                $rsa = str_replace('.', '', $request->get('rsa'));
        
                $cont = 0;
                $Nroitem = 1;
        
                while ($cont < count($id_afiliado_institucion)) {
                    # code...
                    $afiliado = new Apo_Aporte_Afiliado();
                    $afiliado->Id_Afiliado_Institucion = $id_afiliado_institucion[$cont];
                    $afiliado->Id_Departamento =  $id_departamento;
                    $afiliado->Id_InstitucionMunicipal = $id_institucion_municipal;
                    $afiliado->Id_Rendicion = $rendicion->Id_Rendicion;
                    $afiliado->Nro_Item = $Nroitem;
                    $afiliado->Fecha_Aporte = $fecha_aporte;
                    $afiliado->Salario = $salario[$cont];
                    $afiliado->Salario_Bonificacion = $salario_bonificacion[$cont];
                    $afiliado->Aporte_Salario = $aporte_salario[$cont];
                    $afiliado->Aporte_Bonificacion = $aporte_bonficacion[$cont];
                    $afiliado->Primera_Asignacion = $primera_asignacion[$cont];
                    $afiliado->Diferencia_Asignacion = $diferencia_asignacion[$cont];
                    $afiliado->RSA = $rsa[$cont];
                    $afiliado->Id_Estado = 1;
                    $afiliado->Fecha_Alta = $date;                    
                    
                    $afiliado->save();

                    $cont = $cont + 1 ;
                    $Nroitem = $Nroitem + 1 ;
                }
        
                DB::commit();
    
            } catch (\Excepcion $e) {
                //throw $th;
                DB::rollback();
            }
            
            
            return redirect('rendicionaporte/generar');

        }else{

            return redirect('inicio/inicio');

        }

    }

    public function show($id){

        $id_user = auth()->id();

        $rol = DB::table('users_config')   
        ->where('Id_User','=',$id_user)
        ->first();

        $id_rol = $rol->Id_Rol;
        $id_departamento = $rol->Id_Departamento;
        $id_institucion_municipal = $rol->Id_InstitucionMunicipal;
        
        if ($id_rol == 2 || $id_rol == 1) {

            $rendicion = DB::table('apo_Rendicion_Aporte AS a')            
            ->where('a.Id_Rendicion','=',$id)            
            ->first();            
            
            $aporte_afiliado = DB::table('apo_Aporte_Afiliado AS a')
            ->join('apo_Afiliado_Inst_Munic AS b','b.Id_Afiliado_Institucion','=','a.Id_Afiliado_Institucion')
            ->join('leg_Afiliado AS c','c.Id_Legajo','=','b.Id_Legajo')
            ->select('a.*'
            , 'c.Nombre'
            , 'c.Apellido'
            , 'c.Documento')
            ->where('a.Id_Rendicion', '=', $id)
            ->orderby('c.Documento','desc')
            ->paginate(10);

            return view("rendicionaporte.generar.show"
            ,["rendicion"=>$rendicion
            , "aporte_afiliado"=>$aporte_afiliado]);


        }else{

            return redirect('inicio/inicio');

        }
        

    }


}
