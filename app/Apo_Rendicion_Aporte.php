<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apo_Rendicion_Aporte extends Model
{
    //
    protected $table = 'apo_Rendicion_Aporte';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='Id_Rendicion';


    public function getKeyName(){
        return "Id_Rendicion";
    }

}
