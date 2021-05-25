<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pre_Pedido_Refinanciamiento extends Model
{
    //
    protected $table = 'pre_Pedido_Refinanciamento';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='Id_Pedido';


    public function getKeyName(){
        return "Id_Pedido";
    }
}
