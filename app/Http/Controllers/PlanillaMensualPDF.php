<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade AS PDF;
use App\HistoricoPlanilla;
use App\Persona;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\TipoAporte;
use DB;
use App\Exports\PlanillaExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;


use illuminate\Support\Collection;

class PlanillaMensualPDF extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }
    
    public function Generar($id){

        $planilla = DB::table('Planilla_Mensual_Institucion AS a')
        ->join('users AS b', 'b.id','=', 'a.IdInstitucion')
        ->select('a.*', 'b.name')
        ->where('a.IdPlanilla','=', $id)->first();

        $planilla_detalle = DB::table('Planilla_Mensual_Institucion_Detalle AS a')
        ->join('persona AS b','b.idpersona','=','a.idpersona')
        ->join('Tipo_Aporte AS c','c.IdTipo_Aporte','=','a.IdTipo_Aporte')
        ->select('a.idpersona','b.nombre','b.apellido', 'b.cedula', 'a.Salario', 'a.Aporte','a.Primera_Asignacion'
        , 'a.Diferencia_Asignacion', 'a.RSA', 'c.Descripcion AS TipoAporte_Descripcion', 'c.IdTipo_Aporte'
        , DB::raw('ROW_NUMBER() OVER(ORDER BY a.idpersona ASC) AS cant'))
        ->where('a.IdPlanilla','=', $id)
        ->get();
        //return json_encode($planilla, true);
        $PDF = PDF::loadView('pdf\planillamensual\planillaPDF',["planilla"=>$planilla, "planilla_detalle"=>$planilla_detalle]);
        //return $PDF->download();
        return $PDF->stream();
    }


    public function GenerarImport($id){
       

        $planilla = DB::table('Planilla_General_Import AS a')
        ->join('users AS b', 'b.id','=', 'a.IdInstitucion')
        ->select('a.*', 'b.name')
        ->where('a.IdItem','=', $id)
        ->first();

        $Fecha_Planilla = $planilla->Fecha_Planilla;
        $IdInstitucion = auth()->id();

        $planilla_detalle =DB::table('Planilla_Mensual_Institucion_Imports')
        ->where('IdInstitucion','=',$IdInstitucion)
        ->where('Fecha_Planilla','=',$Fecha_Planilla)
        ->get();
        //return json_encode($planilla, true);
        $PDF = PDF::loadView('pdf\planillamensual\planillaImportPDF',["planilla"=>$planilla, "planilla_detalle"=>$planilla_detalle]);
        //return $PDF->download();
        return $PDF->stream();
    }


    public function GenerarHistorico($id){
       
        $IdInstitucion = auth()->id();
        $fechaComoEntero = strtotime($id);

        $Anio = date("Y", $fechaComoEntero);
        $Mes = date("m", $fechaComoEntero);

        $planilla_import = DB::table('Planilla_General_Import AS a')
        ->join('users AS b', 'b.id','=', 'a.IdInstitucion')
        ->select('a.*', 'b.name')
        ->where('a.IdInstitucion','=', $IdInstitucion)
        ->where('Año','=',$Anio)
        ->where('Mes','=',$Mes)
        ->first();


        $planilla = DB::table('Planilla_Mensual_Institucion AS a')
        ->join('users AS b', 'b.id','=', 'a.IdInstitucion')
        ->select('a.*', 'b.name')
        ->where('a.IdInstitucion','=', $IdInstitucion)
        ->where('Año','=',$Anio)
        ->where('Mes','=',$Mes)
        ->first();

        if (empty($planilla_import->IdItem)) {
            
            $planilla_detalle = DB::table('Planilla_Mensual_Institucion_Detalle AS a')
            ->join('persona AS b','b.idpersona','=','a.idpersona')
            ->join('Tipo_Aporte AS c','c.IdTipo_Aporte','=','a.IdTipo_Aporte')
            ->select('a.idpersona','b.nombre','b.apellido', 'b.cedula', 'a.Salario', 'a.Aporte','a.Primera_Asignacion'
            , 'a.Diferencia_Asignacion', 'a.RSA', 'c.Descripcion AS TipoAporte_Descripcion', 'c.IdTipo_Aporte'
            , DB::raw('ROW_NUMBER() OVER(ORDER BY a.idpersona ASC) AS cant'))
            ->where('a.IdPlanilla','=', $planilla->IdPlanilla)
            ->get();

            $PDF1 = PDF::loadView('pdf\planillamensual\historicoPDF',["planilla"=>$planilla, "planilla_detalle"=>$planilla_detalle]);
            //return $PDF->download();
            return $PDF1->stream();
            
        }else{

            $detalle_import =DB::table('Planilla_Mensual_Institucion_Imports')
            ->where('IdInstitucion','=',$IdInstitucion)
            ->where('Fecha_Planilla','=',$planilla_import->Fecha_Planilla)
            ->get();
            $PDF = PDF::loadView('pdf\planillamensual\historicoImportPDF',["planilla"=>$planilla, "detalle_import"=>$detalle_import]);
            //return $PDF->download();
            return $PDF->stream();
        
        }
        
    }


    
}
