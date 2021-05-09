<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AfiliadoInstitucion extends Model
{
    //
    protected $table = 'Afiliado_Institucion';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='IdAfiliado_Institucion';

    public function getKeyName(){
        return "IdAfiliado_Institucions";
    }
}
