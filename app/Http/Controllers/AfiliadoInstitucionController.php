<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AfiliadoInstitucionController extends Controller
{
    //

    public function __construct(){

        $this->middleware('auth');

    }
    
    public function destroy($id){ 

        $persona=Persona::findOrFail($id);
        $persona->tipo_persona='INACTIVO';
        $persona->update();
        return redirect('planillamensual/generar.create');

    }
}
