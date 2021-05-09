<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAporte extends Model
{
    //
    protected $table = 'Tipo_Aporte';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='IdTipo_Aporte';


    public function getKeyName(){
        return "IdTipo_Aporte";
    }
}
