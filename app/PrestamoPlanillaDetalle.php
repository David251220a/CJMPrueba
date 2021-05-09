<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrestamoPlanillaDetalle extends Model
{
    //
        //
        protected $table = 'Prestamo_Planilla_Detalle';

        //protected $table = 'categoria';

        public $timestamps= false;
        protected $guarded = [];
        protected $fillable = [];

        protected $primarykey='IdDetalle';

        public function getKeyName(){
            return "IdDetalle";
        }
}
