<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoPlanilla extends Model
{
    //
    protected $table = 'Planilla_Mensual_Institucion_Detalle';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='IdHistorico';

    public function getKeyName(){
        return "IdHistorico";
    }
}
