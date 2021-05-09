<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PersonaFormRequest;
use DB;

class PlanillaHistoricoController extends Controller
{
    //
    public function index(Request $request){

        $IdInstitucion = auth()->id();

        if($request){

            $planilla =DB::select('pa_Historico_Planilla ?', array($IdInstitucion));
            return view('planillamensual\.historico.index',["planilla"=>$planilla]);

        }

    }
}
