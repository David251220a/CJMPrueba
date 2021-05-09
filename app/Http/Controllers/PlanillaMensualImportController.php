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
use App\PlanillaMensualImports;
use App\Imports\PlanillaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlanillaExport;
use App\Http\Controllers\Storage;

class PlanillaMensualImportController extends Controller
{
    //
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(Request $request){
        
        $IdInstitucion = auth()->id();
        
        $planilla = DB::table('Planilla_General_Import')
        ->where('IdInstitucion', '=', $IdInstitucion)
        ->paginate(7);

        return view('planillamensual\importar.index',["planilla"=>$planilla]);

    }

    public function create(){

        $persona = DB::table('users AS a')
        ->select('a.*')
        ->where('id', '=',auth()->id())
        ->first();

        $planilla = DB::table('Planilla_Mensual_Institucion_Imports AS a')
        ->select('a.*')
        ->where('IdInstitucion', '=', auth()->id())
        ->first();

        return view("planillamensual/importar.create",["persona"=>$persona , "planilla"=>$planilla]);

        

    }

    public function store(Request $request){
        
        $file = $request->file('excel');
        $fecha = $request->get('fecha');
        $IdInstitucion = auth()->id();

        $planilla = DB::table('Planilla_Mensual_Institucion_Imports AS a')
        ->select('a.*')
        ->where('a.IdInstitucion', '=', $IdInstitucion)
        ->where('a.Fecha_Planilla','=', $fecha)
        ->first();


        $auxiliar = DB::table('Planilla_Mensual_Institucion AS a')
        ->select('a.*')
        ->where('a.IdInstitucion', '=',$IdInstitucion)
        ->where('a.FechaPlanilla','=', $fecha)
        ->first();


        if (empty($auxiliar->FechaPlanilla)) {

            if (empty($planilla->Fecha_Planilla)) {
            
                //$import = new AlumnosImport();
                //Excel::import($import, request()->file('alumnos'));
                $nombre= $file->getClientOriginalName();
                Excel::import(new PlanillaImport, $file);
    
                DB::update('exec dbo.pa_Planilla_Importadas_Index ? , ?', array($IdInstitucion , $fecha));
    
                return redirect('planillamensual/importar');
                
            } else {
    
                return back()->with('msj', 'La Planilla de Aporte con esta fecha ya esta importada');
            }
    
        }else{
            return back()->with('msj', 'La Planilla de Aporte con esta fecha ya esta Generada. Revise en Generacion de Planillas!!');
        }

    }



    public function GenerarExcelAyuda(){

        $file=   public_path(). "/ayuda/Ejemplo.xlsx";
        return Response::download($file);
        
    }

    public function destroy($IdItem){

        $auxiliar = DB::table('Planilla_General_Import')
        ->where('IdItem','=', $IdItem)
        ->first();

        $IdInstitucion = $auxiliar->IdInstitucion;
        $Fecha_Planilla = $auxiliar->Fecha_Planilla;

        $planilla_General =DB::table('Planilla_General_Import')
        ->where('IdItem','=', $IdItem)
        ->delete();

        $planilla =DB::table('Planilla_Mensual_Institucion_Imports')
        ->where('IdInstitucion','=',$IdInstitucion)
        ->where('Fecha_Planilla','=',$Fecha_Planilla)
        ->delete();

        return redirect('planillamensual/importar');
        
    }

    public function show($IdItem){
        
        $IdInstitucion = auth()->id();

        $auxiliar = DB::table('Planilla_General_Import')
        ->where('IdItem','=', $IdItem)
        ->first();
        
        $Fecha_Planilla = $auxiliar->Fecha_Planilla;
        
        $planilla = DB::table('Planilla_General_Import')
        ->where('IdInstitucion', '=', $IdInstitucion)
        ->where('Fecha_Planilla','=', $Fecha_Planilla)
        ->first();

        $planilla_detalle =DB::table('Planilla_Mensual_Institucion_Imports')
        ->where('IdInstitucion','=',$IdInstitucion)
        ->where('Fecha_Planilla','=',$Fecha_Planilla)
        ->paginate(10);


        return view('planillamensual\importar.show',["planilla"=>$planilla, "planilla_detalle"=>$planilla_detalle]);

    }

}


