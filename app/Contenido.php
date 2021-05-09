<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    //
    protected $table = 'Contenido';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='IdContenido';

    public function getKeyName(){
        return "IdContenido";
    }
}
