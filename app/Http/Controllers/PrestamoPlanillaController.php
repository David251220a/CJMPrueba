<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade AS PDF;
use App\PrestamoPlanilla;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;
use Response;
use illuminate\Support\Collection;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class PrestamoPlanillaController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(Request $request){

        $IdInstitucion = auth()->id();

        if($request){

            $planilla = DB::table('Prestamo_Planilla AS a')
            ->join('users AS b', 'b.id','=', 'a.IdInstitucion')
            ->select('a.*', 'b.name')
            ->where('Estado','=','A')
            ->orderby('IdPrestamo_Planilla','desc')
            ->paginate(7);
            return view('prestamoplanilla\generar.index',["planilla"=>$planilla]);

        }

    }

    public function create(){

        $persona = DB::table('users AS a')
        ->select('a.*')
        ->get();

        return view("prestamoplanilla/generar.create",["persona"=>$persona]); 

    }

    public function show($IdItem){
        
        $planilla = DB::table('Prestamo_Planilla')
        ->where('IdPrestamo_Planilla', '=', $IdItem)
        ->first();

        $planilla_detalle =DB::table('Prestamo_Planilla_Detalle')
        ->where('IdPrestamo_Planilla','=',$IdItem)
        ->get();

        return view('prestamoplanilla\generar.show',["planilla"=>$planilla, "planilla_detalle"=>$planilla_detalle]);

    }

    public function store(Request $request){
        
        $IdInstitucion = $request->get('IdInstitucion');
        $file = $request->file('excel');
        $fecha = $request->get('fecha');
        $IdInstitucion = auth()->id();

        $auxiliar = DB::table('Prestamo_Planilla AS a')
        ->select('a.*')
        ->where('a.IdInstitucion', '=', $IdInstitucion)
        ->where('a.Fecha_Planilla','=', $fecha)
        ->where('A')
        ->first();

        if (empty($auxiliar->Fecha_Planilla)) {
            
            $nombre= $file->getClientOriginalName();
            Excel::import(new PlanillaImport, $file);

            DB::update('exec dbo.pa_Planilla_Importadas_Index ? , ?', array($IdInstitucion , $fecha));

            return redirect('planillamensual/importar');
    
        }else{
            
            return back()->with('msj', 'La Planilla de Prestamo con esta fecha ya esta Generada. Revise en Generacion de Planillas!!');
        }

     
    }

    public function destroy($IdItem){
        
        $planilla=PrestamoPlanilla::findOrFail($id);
        $planilla->Estado='C';
        $planilla->update();

        return redirect('prestamoplanilla/generar');
        
    }

}
