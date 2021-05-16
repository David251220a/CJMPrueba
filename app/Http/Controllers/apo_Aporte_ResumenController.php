<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;

class apo_Aporte_ResumenController extends Controller
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

            if ($id_rol != 4 || $id_rol != 1 && $id_rol != 3){

                $query=trim($request->get('searchtext'));

                $aporte = DB::table('apo_Aporte_Resumen AS a')
                ->join('apo_Institucion_Municipal AS b','b.Id_Departamento','=','a.Id_Departamento')
                ->join('leg_Departamento AS c','c.Id_Departamento','=','b.Id_Departamento')
                ->select('a.*'
                , 'b.NombreInstitucionMunicipal'
                , 'c.Desc_Departamento')
                ->where('a.Id_InstitucionMunicipal','=','b.Id_InstitucionMunicipal')                
                ->orwhere('b.NombreInstitucionMunicipal','LIKE','%'.$query.'%')                     
                ->orwhere('a.Id_Departamento','LIKE','%'.$query.'%')                
                ->orderby('a.Id_Departamento', 'Asc')
                ->orderby('a.Id_InstitucionMunicipal', 'Asc')
                ->paginate(10);

                return view('resumen\aporte.index', ["aporte"=>$aporte
                , "searchtext"=>$query]);

            }else{

                return redirect('inicio/inicio');
                
            }            

        }

    }

}
