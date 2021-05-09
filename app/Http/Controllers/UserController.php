<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use DB;
use App\User;

class UserController extends Controller
{
    //
    public function __construct(){

        $this->middleware('auth');

    }


}
