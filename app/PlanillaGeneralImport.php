<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanillaGeneralImport extends Model
{
    //
    protected $table = 'Planilla_General_Import';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='IdItem';


    public function getKeyName(){
        return "IdItem";
    }
}
