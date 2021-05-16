@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">

        <h3>Constancia de Aporte</h3>
        @include('constancia.aporte.search')           
        
    </div>

</div>
<br>
<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

        @if (session()->has('msj'))
        <div class="alert alert-info" role="alert">{{session('msj')}}</div>
        @else
        <div class="alert alert-info"  role="alert" style="display:none;">{{session('msj')}}</div>
        @endif                
    </div>

</div>



@endsection
