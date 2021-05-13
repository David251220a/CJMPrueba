<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;

class apo_Afiliado_Inst_MunicController extends Controller
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

            // id_rol 1 = Admin
            // id_rol 2 = Municipio
            // id_rol 3 = Filial
            // id_rol 4 = Miembros
            // id_rol 5 = Operarios
            if ($id_rol == 2 || $id_rol == 1) { 
                
                $query=trim($request->get('searchtext'));
                $afiliado = DB::table('apo_Afiliado_Inst_Munic AS a')
                ->join('leg_Afiliado AS b','b.Id_Legajo','=','a.Id_Legajo')
                ->select('a.*'
                ,'b.Nombre'
                , 'b.Apellido'
                , 'b.Documento'
                , 'b.Celular')
                ->where('b.nombre','LIKE','%'.$query.'%')
                ->where('a.Id_Afiliado_Tipo','=', 1)            
                ->orwhere('b.Documento','LIKE','%'.$query.'%')
                ->where('a.Id_Afiliado_Tipo','=', 1)
                ->where('a.Id_Departamento','=',$id_departamento)
                ->where('a.Id_InstitucionMunicipal','=',$id_institucion_municipal)
                ->orderby('b.Documento','desc')
                ->paginate(7);
                
                return view('afiliado\persona.index',["afiliado"=>$afiliado, "searchtext"=>$query]);
            
            }

            if ($id_rol == 3 ) {

                $query=trim($request->get('searchtext'));
                $afiliado = DB::table('apo_Afiliado_Inst_Munic AS a')
                ->join('leg_Afiliado AS b','b.Id_Legajo','=','a.Id_Legajo')
                ->select('a.*'
                ,'b.Nombre'
                , 'b.Apellido'
                , 'b.Documento'
                , 'b.Celular')
                ->where('b.nombre','LIKE','%'.$query.'%')
                ->where('a.Id_Afiliado_Tipo','=', 1)            
                ->orwhere('b.Documento','LIKE','%'.$query.'%')
                ->where('a.Id_Afiliado_Tipo','=', 1)
                ->where('a.Id_Departamento','=',$id_departamento)                
                ->orderby('b.Documento','desc')
                ->paginate(7);
            
                return view('afiliado\persona.index',["afiliado"=>$afiliado, "searchtext"=>$query]);
            
            }

            if ($id_rol == 4 || $id_rol == 5) {                   
                
                return redirect('inicio/inicio');
            
            }

        }

    }

    public function create(){     

        $departamento = DB::table('leg_Departamento')
        ->orderby('Id_Departamento','asc')
        ->get();
        return view("afiliado.persona.create", ["departamento"=>$departamento]);

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

}
