@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">

        <h3>Constancia de Aporte</h3>
        @include('constancia.aporte.search')           
        
    </div>

</div>


@endsection
