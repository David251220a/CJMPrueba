<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\AfiliadoInstitucion;
use App\TipoAporte;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;
class PersonaController extends Controller
{
    //
    public function __construct(){

        $this->middleware('auth');

    }


    public function index(Request $request){

        $IdInstitucion = auth()->id();

        if($request){

            $query=trim($request->get('searchtext'));
            $persona = DB::table('persona')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('tipo_persona','=','AFILIADO')
            ->where('IdInstitucion','=',$IdInstitucion)
            ->orwhere('cedula','LIKE','%'.$query.'%')
            ->where('tipo_persona','=','AFILIADO')
            ->where('IdInstitucion','=',$IdInstitucion)
            ->orderby('idpersona','desc')
            ->paginate(7);
            return view('afiliado\persona.index',["persona"=>$persona, "searchtext"=>$query]);

        }

    }

    public function show($id){

        $tipo_aporte=DB::table('Tipo_Aporte')->get();

        $afiliado = DB::table('persona AS a')
        ->join('Afiliado_Institucion AS b','b.idpersona','=','a.idpersona')
        ->join('Tipo_Aporte AS c','c.IdTipo_Aporte','=','b.IdTipo_Aporte')
        ->select('a.idpersona','a.nombre','a.apellido', 'a.cedula', 'b.Salario', 'b.Aporte','b.Primera_Asignacion'
        , 'b.Diferencia_Asignacion', 'b.RSA', 'c.Descripcion', 'c.IdTipo_Aporte')
        ->where('a.idpersona','=',$id)
        ->get();

        return view("afiliado.persona.show"
        ,["persona"=>Persona::findOrFail($id)]);


    }

    public function store(Request $request){
       
        $IdInstitucion = auth()->id();

        try {
            
            DB::beginTransaction();

            $persona = new Persona();
            $persona->nombre = $request->get('nombre');
            $persona->apellido = $request->get('apellido');
            $persona->cedula = $request->get('cedula');
            $persona->direccion = $request->get('direccion');
            $persona->telefono = $request->get('telefono');
            $persona->email = $request->get('email');
            $persona->IdInstitucion = $IdInstitucion;
            $persona->tipo_persona = "AFILIADO";

            $persona->save();
    
            $idtipo_aporte = $request->get('idtipo_aporte');
            $salario = $request->get('salario');
            $primera_asignacion = $request->get('primera_asignacion');
            $diferencia_asignacion = $request->get('diferencia_asignacion');
            $aporte = $request->get('aporte');
            $rsa = $request->get('rsa');

            $cont = 0;

            while ($cont < count($idtipo_aporte)) {
                # code...
                $afiliado = new AfiliadoInstitucion();
                $afiliado->idpersona = $persona->idpersona;
                $afiliado->IdInstitucion =  auth()->id();
                $afiliado->IdTipo_Aporte = $idtipo_aporte[$cont];
                $afiliado->Salario = $salario[$cont];
                $afiliado->Aporte = $aporte[$cont];
                $afiliado->Primera_Asignacion = $primera_asignacion[$cont];
                $afiliado->Diferencia_Asignacion = $diferencia_asignacion[$cont];
                $afiliado->RSA = $rsa[$cont];
                $afiliado->save();
                $cont = $cont + 1 ;  
            }

            DB::commit();

        } catch (\Excepcion $e) {
            //throw $th;
            DB::rollback();
        }

        return redirect('afiliado/persona');

    }


    public function create(){

        $tipo_aporte=DB::table('Tipo_Aporte')->get();

        return view("afiliado.persona.create",["tipo_aporte"=>$tipo_aporte]);

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

        return view("afiliado.persona.edit"
        ,["persona"=>Persona::findOrFail($id), "tipo_aporte"=>$tipo_aporte, "afiliado"=>$afiliado]);

    }

    public function update(Request $request, $id){

        $IdInstitucion = auth()->id();

        try {
            
            DB::beginTransaction();

            $persona=Persona::findOrFail($id);
            $persona->nombre = $request->get('nombre');
            $persona->apellido = $request->get('apellido');
            $persona->cedula = $request->get('cedula');
            $persona->direccion = $request->get('direccion');
            $persona->telefono = $request->get('telefono');
            $persona->email = $request->get('email');
            $persona->update();
            
            $idtipo_aporte = $request->get('idtipo_aporte');
            $salario = $request->get('salario');
            $primera_asignacion = $request->get('primera_asignacion');
            $diferencia_asignacion = $request->get('diferencia_asignacion');
            $aporte = $request->get('aporte');
            $rsa = $request->get('rsa');

            $cont = 0;

           
            # code...
            $afiliado =DB::table('Afiliado_Institucion')
            ->where('idpersona','=',$id)->delete();

                
            while ($cont < count($idtipo_aporte)) {
                # code...
                $afiliado = new AfiliadoInstitucion();
                $afiliado->idpersona = $persona->idpersona;
                $afiliado->IdInstitucion = $IdInstitucion;
                $afiliado->IdTipo_Aporte = $idtipo_aporte[$cont];
                $afiliado->Salario = $salario[$cont];
                $afiliado->Aporte = $aporte[$cont];
                $afiliado->Primera_Asignacion = $primera_asignacion[$cont];
                $afiliado->Diferencia_Asignacion = $diferencia_asignacion[$cont];
                $afiliado->RSA = $rsa[$cont];
                $afiliado->save();
                $cont = $cont + 1 ;  
            }
    
            
            DB::commit();

        } catch (\Excepcion $e) {
            //throw $th;
            DB::rollback();
        }

        return redirect('afiliado/persona');

    }

    public function destroy($id){ 

        $persona=Persona::findOrFail($id);
        $persona->tipo_persona='INACTIVO';
        $persona->update();

        return redirect('afiliado/persona');

    }

}
