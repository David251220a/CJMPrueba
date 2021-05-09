<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table = 'persona';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='idpersona';

    public function getKeyName(){
        return "idpersona";
    }


}
