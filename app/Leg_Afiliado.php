<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leg_Afiliado extends Model
{
    //
    protected $table = 'leg_Afiliado';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='Id_Legajo';


    public function getKeyName(){
        return "Id_Legajo";
    }

}
