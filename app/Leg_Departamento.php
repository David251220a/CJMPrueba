<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leg_Departamento extends Model
{
    //
    protected $table = 'leg_Departamento';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='Id_Departamento';


    public function getKeyName(){
        return "Id_Departamento";
    }

}
