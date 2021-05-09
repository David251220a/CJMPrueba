<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrestamoPlanilla extends Model
{
    //
    protected $table = 'Prestamo_Planilla';

    //protected $table = 'categoria';

    public $timestamps= false;
    protected $guarded = [];
    protected $fillable = [];

    protected $primarykey='IdPrestamoPlanilla';

    public function getKeyName(){
        return "IdPrestamoPlanilla";
    }
}
