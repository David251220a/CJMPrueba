<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;
use App\Apo_Afiliado_Inst_Munic;

class apo_Afiliado_Inst_Munic_Inactivo_Controller extends Controller
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
                ->where('a.Id_Afiliado_Tipo','=', 9)            
                ->orwhere('b.Documento','LIKE','%'.$query.'%')
                ->where('a.Id_Afiliado_Tipo','=', 9)
                ->where('a.Id_Departamento','=',$id_departamento)
                ->where('a.Id_InstitucionMunicipal','=',$id_institucion_municipal)
                ->orderby('b.Documento','desc')
                ->paginate(7);
                
                return view('afiliado\personainactiva.index',["afiliado"=>$afiliado, "searchtext"=>$query]);
            
            }
           

            if ($id_rol == 4 || $id_rol == 3 || $id_rol == 5) {                   
                
                return redirect('inicio/inicio');
            
            }

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
            $afiliado_institucion->Id_Afiliado_Tipo = 1;
            $afiliado_institucion->update();

            return redirect('afiliado/personainactiva');

        }else{
            
            return redirect('inicio/inicio');

        }
        

    }
}
