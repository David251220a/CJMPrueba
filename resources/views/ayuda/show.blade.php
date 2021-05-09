@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <LEGEND><b> <i> <u><h3> {{$contenido->Titulo}}</h3></u></i></b> </LEGEND>
            <label for="">{{$contenido->Descripcion}} </label>

        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <br><br>
            
            <div class="video-responsive" >
                <div style="text-align: center">
                    <iframe src="{{$contenido->Video}}" frameborder="0" allowfullscreen  width="560" height="315"></iframe>
                </div>
            </div>

        </div>    
    </div>

    <div class="row">
    
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <br>
            <br>
            <p><label for="">{{$contenido->Contenido}}</label>
                <a href="{{$contenido->Enlaces}}" target="_blank">
                    descargar.</a> 
            </p>
            

        </div>    
        

    </div>
   
@endsection