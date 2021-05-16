<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;
use App\Leg_Afiliado;
use App\Apo_Afiliado_Inst_Munic;
use Carbon\Carbon;

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
           

            if ($id_rol == 4 || $id_rol == 3 || $id_rol == 5) {                   
                
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
       
        $id_user = auth()->id();
        
        $rol = DB::table('users_config')   
        ->where('Id_User','=',$id_user)
        ->first();

        $id_legajo = 0;

        $id_rol = $rol->Id_Rol;
        $id_departamento = $rol->Id_Departamento;
        $id_institucion_municipal = $rol->Id_InstitucionMunicipal;

        $dependencia = DB::table('apo_Institucion_Municipal')   
        ->where('Id_Departamento','=',$id_departamento)
        ->where('Id_InstitucionMunicipal','=',$id_institucion_municipal)
        ->first();

        $id_dependencia = $dependencia->DependenciaCobol;

        $verificacion_persona = DB::table('leg_Afiliado')   
        ->where('Documento','=',$request->get('cedula'))
        ->first();                        

        if ($id_rol == 2 || $id_rol == 1) { 

            try {
            
                DB::beginTransaction();                                                

                if (empty($verificacion_persona->Documento)){

                    $persona = new Leg_Afiliado();
                    $persona->Nombre = $request->get('nombre');
                    $persona->Apellido = $request->get('apellido');
                    $persona->Documento = $request->get('cedula');
                    //$persona->Direccion = $request->get('direccion');
                    $persona->Celular = $request->get('celular');
                    $persona->Sexo = $request->get('sexo');
                    $persona->Barrio = $request->get('barrio');
                    $persona->Id_Departamento = $request->get('departamento');
                    $persona->Ciudad = $request->get('ciudad');
                    $persona->Id_Afiliado_Tipo = 1;
                    $persona->Dependencia = $id_dependencia;
        
                    $persona->save();

                    $id_legajo = $persona->Id_Legajo;

                }else{

                    $id_legajo = $verificacion_persona->Id_Legajo;            

                }

                $verificacion_afiliado = DB::table('apo_Afiliado_Inst_Munic')
                ->where('Id_Legajo','=',$id_legajo)
                ->where('Id_Departamento','=',$id_departamento)
                ->where('Id_InstitucionMunicipal','=',$id_institucion_municipal)
                ->first();

                if (empty($verificacion_afiliado->Id_Legajo)){

                    $salario = $request->get('salario');
                    $salario_bonificacion = $request->get('salario_bonificacion');
                    $aporte_salario = $request->get('aporte_salario');
                    $aporte_bonficacion = $request->get('aporte_bonficacion');
                    $primera_asignacion = $request->get('primera_asignacion');
                    $diferencia_asignacion = $request->get('diferencia_asignacion');
                    $aporte = $request->get('aporte');
                    $rsa = $request->get('rsa');

                    $date = Carbon :: now ();
                    $date1 = $date->format('d-m-Y');
                    $fechaComoEntero = strtotime($date1);
                    $año = date("Y", $fechaComoEntero);
                    $mes = date("m", $fechaComoEntero);
        
                    $cont = 0;
        
                    while ($cont < count($salario)) {
                        # code...
                        $afiliado = new Apo_Afiliado_Inst_Munic();
                        $afiliado->Id_Legajo = $id_legajo;
                        $afiliado->Id_Departamento =  $id_departamento;
                        $afiliado->Id_InstitucionMunicipal = $id_institucion_municipal;                    
                        $afiliado->Salario = $salario[$cont];
                        $afiliado->Salario_Bonificacion = $salario_bonificacion[$cont];
                        $afiliado->Aporte_Salario = $aporte_salario[$cont];
                        $afiliado->Aporte_Salario_Bonificacion = $aporte_bonficacion[$cont];
                        $afiliado->Primera_Asignacion = $primera_asignacion[$cont];
                        $afiliado->Diferencia_Asignacion = $diferencia_asignacion[$cont];
                        $afiliado->RSA = $rsa[$cont];
                        $afiliado->FechaIngreso = $date;
                        $afiliado->MesInicioAportes = $mes;
                        $afiliado->AñoInicioAportes = $año;
                        $afiliado->Id_Afiliado_Tipo = 1;
                        $afiliado->save();
                        $cont = $cont + 1 ;
                    }
        

                }else{            
        
                    return back()->with('msj', 'Ya existe afiliado con este numero de cedula en este Municipio. Revise en Funcionario - Persona Inactiva!!!');
        
                }
        
                
                DB::commit();
    
            } catch (\Excepcion $e) {
                //throw $th;
                DB::rollback();
            }

            return redirect('afiliado/persona');

        }else{

            return redirect('inicio/inicio');

        }

    }

    public function destroy($id){ 

        $id_user = auth()->id();
        
        $rol = DB::table('users_config')   
        ->where('Id_User','=',$id_user)
        ->first();

        $id_rol = $rol->Id_Rol;

        if ($id_rol == 2 || $id_rol == 1){

            $afiliado_institucion=Apo_Afiliado_Inst_Munic::findOrFail($id);
            $afiliado_institucion->Id_Afiliado_Tipo = 9;           
            $afiliado_institucion->update();

            return redirect('afiliado/persona');

        }else{
            
            return redirect('inicio/inicio');

        }
        

    }

    public function edit($id){        

        $id_user = auth()->id();
        
        $rol = DB::table('users_config')   
        ->where('Id_User','=',$id_user)
        ->first();

        $id_rol = $rol->Id_Rol;
        $id_departamento = $rol->Id_Departamento;
        $id_institucion_municipal = $rol->Id_InstitucionMunicipal;

        if ($id_rol == 2 || $id_rol == 1) { 
                            
            $afiliado = DB::table('apo_Afiliado_Inst_Munic')                
            ->where('Id_Legajo','=',$id)
            ->get();
            
            $persona = DB::table('leg_Afiliado')                
            ->where('Id_Legajo','=',$id)
            ->first();

            return view("afiliado.persona.edit"
            ,["afiliado"=>$afiliado
            , "persona"=>$persona]);
        
        }else{

            return redirect('inicio/inicio');

        }           

    }

    public function update(Request $request, $id){ 

        $id_user = auth()->id();
        
        $rol = DB::table('users_config')   
        ->where('Id_User','=',$id_user)
        ->first();

        $id_rol = $rol->Id_Rol;
        $id_departamento = $rol->Id_Departamento;
        $id_institucion_municipal = $rol->Id_InstitucionMunicipal;

        if ($id_rol == 2 || $id_rol == 1){

            $persona=Leg_Afiliado::findOrFail($id);
            $persona->Apellido = $request->get('apellido');
            $persona->Documento = $request->get('cedula');
            $persona->Direccion = $request->get('direccion');
            $persona->Celular = $request->get('celular');
            //$persona->Sexo = $request->get('sexo');
            //$persona->Barrio = $request->get('barrio');
            //$persona->Id_Departamento = $request->get('departamento');
            //$persona->Ciudad = $request->get('ciudad');            
            $persona->update();

            $salario = $request->get('salario');
            $salario_bonificacion = $request->get('salario_bonificacion');
            $aporte_salario = $request->get('aporte_salario');
            $aporte_bonficacion = $request->get('aporte_bonficacion');
            $primera_asignacion = $request->get('primera_asignacion');
            $diferencia_asignacion = $request->get('diferencia_asignacion');
            $aporte = $request->get('aporte');
            $rsa = $request->get('rsa');

            $afi=DB::table('apo_Afiliado_Inst_Munic')
            ->where('Id_Legajo','=',$id)
            ->where('Id_Departamento','=',$id_departamento)
            ->where('Id_InstitucionMunicipal','=',$id_institucion_municipal)
            ->first();

            $cont = 0;

            $afiliado_institucion = Apo_Afiliado_Inst_Munic::where('Id_Afiliado_Institucion','=', $afi->Id_Afiliado_Institucion)
            ->first();
            $afiliado_institucion->Salario = $salario[$cont];
            $afiliado_institucion->Salario_Bonificacion = $salario_bonificacion[$cont];
            $afiliado_institucion->Aporte_Salario = $aporte_salario[$cont];
            $afiliado_institucion->Aporte_Salario_Bonificacion = $aporte_bonficacion[$cont];
            $afiliado_institucion->Primera_Asignacion = $primera_asignacion[$cont];
            $afiliado_institucion->Diferencia_Asignacion = $diferencia_asignacion[$cont];
            $afiliado_institucion->RSA = $rsa[$cont];
            $afiliado_institucion->save();

            return redirect('afiliado/persona');

        }else{
            
            return redirect('inicio/inicio');

        }
        

    }


}
