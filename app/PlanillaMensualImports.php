<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanillaMensualImports extends Model
{
    //

    protected $table = 'Planilla_Mensual_Institucion_Imports';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $guarded = [];

    protected $primarykey='IdImport';
    protected $fillable = [];


    public function getKeyName(){
        return "IdImport";
    }
}
