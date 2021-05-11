<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users_config extends Model
{
    //
    protected $table = 'users_config';

    //protected $table = 'categoria';

    public $timestamps= false;

    protected $primarykey='Id_Users_Config';


    public function getKeyName(){
        return "Id_Users_Config";
    }

}
