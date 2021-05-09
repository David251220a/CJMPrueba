@extends('layouts.admin')

@section('contenido')
    
    @include('ayuda.search')

    @foreach ($contenido as $con)
        
        <div class="row">

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                <LEGEND><b> <i> <u><h3> {{$con->Titulo}}</h3></u></i></b> </LEGEND>
                <label for="">{{$con->Descripcion}} </label>
                <a href="{{URL::action('AyudaController@show', $con->IdContenido)}}">
                    <button class="btn btn-info ; btn btn-secondary pull-right">Ver</button>
            </a>

            </div>

        </div>

    @endforeach
    
@endsection