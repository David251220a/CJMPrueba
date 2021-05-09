<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\AfiliadoInstitucion;
use App\TipoAporte;
use App\PlanillaMensual;
use Barryvdh\DomPDF\Facade AS PDF;
use App\HistoricoPlanilla;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;
use Response;
use illuminate\Support\Collection;
use Carbon\Carbon;

class PlanillaMensualController extends Controller
{
    //
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(Request $request){

        $IdInstitucion = auth()->id();

        if($request){

            $planilla = DB::table('Planilla_Mensual_Institucion AS a')
            ->select('a.*', DB::raw('CONVERT (DATETIME,a.FechaPlanilla,103) AS Fecha'))
            ->where('IdInstitucion','=',$IdInstitucion)
            ->where('Estado','=','A')
            ->orderby('IdPlanilla','desc')
            ->paginate(7);
            return view('planillamensual\generar.index',["planilla"=>$planilla]);

        }

    }

    public function destroy($id){ 


        $planilla_detalle =DB::table('Planilla_Mensual_Institucion_Detalle')
        ->where('IdPlanilla','=', $id)
        ->delete();

        $planilla =DB::table('Planilla_Mensual_Institucion')
        ->where('IdPlanilla','=',$id)
        ->delete();

        return redirect('planillamensual/generar');

    }


    public function create(){

        $IdInstitucion = auth()->id();
        
        $persona = DB::table('persona AS a')
        ->select(DB::raw('count(*) as cantidad'))
        ->where('IdInstitucion', '=',$IdInstitucion)
        ->where('tipo_persona','=','AFILIADO')
        ->first();
        
        $afiliado = DB::table('persona AS a')
        ->join('Afiliado_Institucion AS b','b.idpersona','=','a.idpersona')
        ->join('Tipo_Aporte AS c','c.IdTipo_Aporte','=','b.IdTipo_Aporte')
        ->select('a.idpersona','a.nombre','a.apellido', 'a.cedula', 'b.Salario', 'b.Aporte','b.Primera_Asignacion'
        , 'b.Diferencia_Asignacion', 'b.RSA', 'c.Descripcion', 'c.IdTipo_Aporte')
        ->where('a.tipo_persona','=','AFILIADO')
        ->where('a.IdInstitucion','=',$IdInstitucion)->get();

        return view("planillamensual.generar.create",["afiliado"=>$afiliado, "persona"=>$persona]);

    }

    public function edit($id){

        $tipo_aporte=DB::table('Tipo_Aporte')->get();

        $afiliado = DB::table('persona AS a')
        ->join('Afiliado_Institucion AS b','b.idpersona','=','a.idpersona')
        ->join('Tipo_Aporte AS c','c.IdTipo_Aporte','=','b.IdTipo_Aporte')
        ->select('a.idpersona','a.nombre','a.apellido', 'a.cedula', 'b.Salario', 'b.Aporte','b.Primera_Asignacion'
        , 'b.Diferencia_Asignacion', 'b.RSA', 'c.Descripcion', 'c.IdTipo_Aporte')
        ->where('a.idpersona','=',$id)
        ->get();


        return view("planillamensual.generar.edit"
        ,["persona"=>Persona::findOrFail($id), "tipo_aporte"=>$tipo_aporte, "afiliado"=>$afiliado ]);

    }

    public function show($id){

        $IdInstitucion = auth()->id();

        $planilla = DB::table('Planilla_Mensual_Institucion AS a')
        ->join('users AS b', 'b.id','=', 'a.IdInstitucion')
        ->select('a.*', 'b.name', DB::raw('CONVERT(DATETIME, a.FechaPlanilla, 103) AS Fecha'))
        ->where('a.IdPlanilla','=', $id)->first();

        $planilla_detalle = DB::table('Planilla_Mensual_Institucion_Detalle AS a')
        ->join('persona AS b','b.idpersona','=','a.idpersona')
        ->join('Tipo_Aporte AS c','c.IdTipo_Aporte','=','a.IdTipo_Aporte')
        ->select('a.idpersona','b.nombre','b.apellido', 'b.cedula', 'a.Salario', 'a.Aporte','a.Primera_Asignacion'
        , 'a.Diferencia_Asignacion', 'a.RSA', 'c.Descripcion AS TipoAporte_Descripcion', 'c.IdTipo_Aporte'
        , DB::raw('ROW_NUMBER() OVER(ORDER BY a.idpersona ASC) AS cant'))
        ->where('a.IdPlanilla','=', $id)
        ->paginate(7);


        return view("planillamensual.generar.show"
        ,["planilla"=>$planilla, "planilla_detalle"=>$planilla_detalle]);

    }

    public function store(Request $request){
       
        $Fecha = $request->get('fecha');
        $IdInstitucion = auth()->id();

        $existe = DB::table('Planilla_Mensual_Institucion AS a')
        ->select('a.*')
        ->where('a.IdInstitucion','=', $IdInstitucion)
        ->where('a.FechaPlanilla','=',$Fecha)
        ->first();

        $existe_import = DB::table('Planilla_Mensual_Institucion_Imports AS a')
        ->select('a.*')
        ->where('a.IdInstitucion', '=', $IdInstitucion)
        ->where('a.Fecha_Planilla','=', $Fecha)
        ->first();

        if (empty($existe_import->Fecha_Planilla)) {

            if (empty($existe->FechaPlanilla)) {
              
                try {
    
                    DB::beginTransaction();
    
                    $planilla = new PlanillaMensual();
                    
                    $Fecha = $request->get('fecha');

                    $fechaComoEntero = strtotime($Fecha);

                    $anio = date("Y", $fechaComoEntero);
                    $mes = date("m", $fechaComoEntero);
    
                    $planilla->IdInstitucion =  $IdInstitucion;
                    $planilla->FechaPlanilla = $Fecha;
                    $planilla->Mes = $mes;
                    $planilla->Año = $anio;
                    $planilla->Cantidad = $request->get('cantidad');
                    $planilla->Estado = 'A';
                    $planilla->TotalAporte = $request->get('total_aporte');
                    $planilla->TotalPrimera_Asignacion = $request->get('total_primera_asig');
                    $planilla->TotalDiferencia_Asignacion = $request->get('total_diferencia_asig');
                    $planilla->TotalRSA = $request->get('total_rsa');
                    $planilla->TotalBonificacion = $request->get('total_bonificacion');
                    $planilla->TotalAporte_sinBonificacion = $request->get('total_aporte_sinboni');
                    $planilla->Total_General = $request->get('total_general');
    
                    $planilla->save();
            
                    $idtipo_aporte = $request->get('idtipo_aporte');
                    $salario = $request->get('salario');
                    $primera_asignacion = $request->get('primera_asig');
                    $diferencia_asignacion = $request->get('diferencia_asig');
                    $aporte = $request->get('aporte');
                    $rsa = $request->get('rsa');
                    $contador = $request->get('cont');
                    $idpersona =$request->get('idpersona');
    
                    $cont = 0;
    
                    while ($cont < count($idpersona)) {
                        # code...
                        $planilla_detalle = new HistoricoPlanilla();
                        $planilla_detalle->IdPlanilla = $planilla->IdPlanilla;
                        $planilla_detalle->idpersona = $idpersona[$cont];
                        $planilla_detalle->IdInstitucion = $IdInstitucion;
                        $planilla_detalle->IdTipo_Aporte = $idtipo_aporte[$cont];
                        $planilla_detalle->Salario = $salario[$cont];
                        $planilla_detalle->Aporte = $aporte[$cont];
                        $planilla_detalle->Primera_Asignacion = $primera_asignacion[$cont];
                        $planilla_detalle->Diferencia_Asignacion = $diferencia_asignacion[$cont];
                        $planilla_detalle->RSA = $rsa[$cont];
                        $planilla_detalle->save();
                        $cont = $cont + 1 ;  
                    }
    
                    DB::commit();
    
                    return redirect('planillamensual/generar');
    
                } catch (\Excepcion $e) {
                    //throw $th;
                    DB::rollback();
                }
    
            } else {
    
                return back()->with('msj', 'La Planilla de Aporte con esta fecha ya esta generada.');
            
            }

        }else{
            return back()->with('msj', 'La Planilla de Aporte con esta fecha ya esta generada. Revise en Planillas Importadas!!');
        }

    }

}
