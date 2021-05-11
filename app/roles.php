<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    //
    protected $table = 'roles';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='id_rol';


    public function getKeyName(){
        return "id_rol";
    }    

}
