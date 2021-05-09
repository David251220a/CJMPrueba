<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanillaMensual extends Model
{
    //
    protected $table = 'Planilla_Mensual_Institucion';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='IdPlanilla';


    public function getKeyName(){
        return "IdPlanilla";
    }

}
