<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedores extends Model
{
    protected $table = 'Vendedores';
    //
    public $timestamps= false;

    protected $guarded = [];

    protected $primarykey='IdVendedor';
    protected $fillable = [];


    public function getKeyName(){
        return "IdVendedor";
    }
}
