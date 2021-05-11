<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apo_Institucion_Municipal extends Model
{
    //
    protected $table = 'apo_Institucion_Municipal';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='Id_InstitucionMunicipal';


    public function getKeyName(){
        return "Id_InstitucionMunicipal";
    }

}
