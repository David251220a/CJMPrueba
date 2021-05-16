<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apo_Afiliado_Inst_Munic extends Model
{
    //
    protected $table = 'apo_Afiliado_Inst_Munic';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='Id_Afiliado_Institucion';


    public function getKeyName(){
        return "Id_Afiliado_Institucion";
    }
}
