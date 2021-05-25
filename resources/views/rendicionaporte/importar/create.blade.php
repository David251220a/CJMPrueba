@extends('layouts.admin')

@section('contenido')

    @if (session()->has('msj'))
    <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
    @else
        
    @endif


    <div class="row">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h3>Nueva Planilla de {{$institucion_municipal->NombreInstitucionMunicipal}}</h3>
            
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    
                <ul>
                  @foreach ($errors->all() as $error)

                    <li>{{$error}}</li>
                      
                  @endforeach  
                </ul>

                </div>
                
            @endif
        
        </div>

    </div>

    {!! Form::open(array('url'=>'rendicionaporte/importar', 'method'=>'POST', 'autocomplete'=>'off','file'=>'true', 'enctype'=>"multipart/form-data"))!!}
    {{Form::token()}}


    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="excel" >Seleccionar Archivo Excel</label>
                <input type="file" name="excel" class="form-control" required>

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">
    
                <label for="fecha" >Seleccionar Fecha Aporte</label>
                <input type="date" name="fecha" class="form-control" value="2020-01-31" required>
    
            </div>
            
        </div>

    </div>


    

    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

            <div class="form-group">

                <button class="btn btn-primary" type="submit">Enviar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>  
            </div>

        </div>    

    </div>
    
    {!! Form::close() !!}

    <div class="row">
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

            <div class="form-group">
                <a href="#">
                    <button class="btn btn-info" style='width:145px; height:50'>Excel de Ayuda</button>
               </a>
            </div>
    
            </div>    

    </div>
   
@endsection