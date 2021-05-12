<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apo_Situacion extends Model
{
    //
    protected $table = 'apo_Situacion';

    //protected $table = 'categoria';

    public $timestamps= false;
    protected $guarded = [];
    protected $fillable = [];

    protected $primarykey='Id_Situacion';

    public function getKeyName(){
        return "Id_Situacion";
    }
}
